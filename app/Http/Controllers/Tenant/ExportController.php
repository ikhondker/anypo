<?php


/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			ExportController.php
* @brief		This file contains the implementation of the ExportController
* @path			\App\Http\Controllers\Tenant
* @author		Iqbal H. Khondker <ihk@khondker.com>
* @created		4-JAN-2024
* @copyright	(c) Iqbal H. Khondker <ihk@khondker.com>
* =====================================================================================
* Revision History:
* Date			Version	Author				Comments
* -------------------------------------------------------------------------------------
* 24-DEC-2024	v1.0	Iqbal H Khondker	Created
* DD-MON-YYYY	v1.1	Iqbal H Khondker	Modification brief
* =====================================================================================
*/


namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;

use App\Models\Tenant\Export;
use App\Http\Requests\Tenant\StoreExportRequest;
use App\Http\Requests\Tenant\UpdateExportRequest;

# 1. Models
use App\Models\User;
use App\Models\Tenant\Pr;
use App\Models\Tenant\Prl;

use App\Models\Tenant\Po;
use App\Models\Tenant\Pol;

use App\Models\Tenant\Invoice;
use App\Models\Tenant\InvoiceLine;
use App\Models\Tenant\Payment;
use App\Models\Tenant\Receipt;

use App\Models\Tenant\Budget;
use App\Models\Tenant\DeptBudget;

use App\Models\Tenant\Ae\Ael;

use App\Models\Tenant\Lookup\Dept;
use App\Models\Tenant\Lookup\Project;
use App\Models\Tenant\Lookup\Warehouse;
use App\Models\Tenant\Lookup\Supplier;
use App\Models\Tenant\Lookup\BankAccount;

use App\Models\Tenant\Admin\Setup;
# 2. Enums
use App\Enum\EntityEnum;
use App\Enum\UserRoleEnum;
use App\Enum\Tenant\AuthStatusEnum;
use App\Enum\Tenant\InvoiceStatusEnum;
# 3. Helpers
use App\Helpers\EventLog;
# 4. Notifications
# 5. Jobs
# 6. Mails
# 7. Rules
# 8. Packages
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
# 9. Exceptions
# 10. Events
# 11. Controller
# 12. Seeded
use DB;
use Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Gate;

# 13. FUTURE
# 1 . Add entity column in reports.index



class ExportController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->authorize('viewAny',Export::class);

		$exports = Export::query();
		if (request('term')) {
			$exports->where('name', 'Like', '%'.request('term').'%');
		}
		if(auth()->user()->role->value == UserRoleEnum::SYS->value) {
			$exports = $exports->orderBy('order_by1', 'ASC')->orderBy('order_by2', 'ASC')->paginate(100);
			return view('tenant.exports.all', compact('exports'));
		} else {
			$exports = $exports->where('enable', true)->orderBy('order_by1', 'ASC')->orderBy('order_by2', 'ASC')->paginate(100);
			return view('tenant.exports.index', compact('exports'));
		}
	}

	public function pr()
	{
		return view('tenant.prs.export');
	}

	public function prl()
	{
		return view('tenant.prls.export');
	}

	public function po()
	{
		return view('tenant.pos.export');
	}

	public function pol()
	{
		return view('tenant.pols.export');
	}

	public function invoice()
	{
		return view('tenant.invoices.export');
	}

	public function payment()
	{
		return view('tenant.payments.export');
	}

	public function receipt()
	{
		return view('tenant.receipts.export');
	}

	public function ael()
	{
		return view('tenant.ae.aels.export');
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function run(UpdateExportRequest $request, Export $export)
	{

		$entity				= $request->input('entity');
		$article_id			= $request->input('article_id');
		$start_date			= $request->input('start_date');
		$end_date			= $request->input('end_date');
		$currency			= $request->input('currency');
		$dept_id			= $request->input('dept_id');
		$supplier_id		= $request->input('supplier_id');
		$project_id			= $request->input('project_id');
		$warehouse_id		= $request->input('warehouse_id');
		$bank_account_id	= $request->input('bank_account_id');
		$user_id			= $request->input('user_id');

		Log::debug('tenant.export.run article_id = '.$article_id);
		Log::debug('tenant.export.run start_date = '.$start_date);
		Log::debug('tenant.export.run end_date = '.$end_date);
		Log::debug('tenant.export.run user_id = '.$user_id);
		Log::debug('tenant.export.run entity = '.$export->entity);

		// Increase exports run_count -------------------------
		self::increaseRunCounter(Str::lower($export->entity));

		switch ($export->entity) {
			case EntityEnum::PR->value:
				return self::exportPr($start_date, $end_date, $currency, $dept_id, $supplier_id, $project_id, $warehouse_id, $bank_account_id, $user_id);
			case EntityEnum::PRL->value:
				return self::exportPrl($start_date, $end_date, $currency, $dept_id, $supplier_id, $project_id, $warehouse_id, $bank_account_id, $user_id);
				break;
			case EntityEnum::PO->value:
				return self::exportPo($start_date, $end_date, $currency, $dept_id, $supplier_id, $project_id, $warehouse_id, $bank_account_id, $user_id);
				break;
			case EntityEnum::POL->value:
				return self::exportPol($start_date, $end_date, $currency, $dept_id, $supplier_id, $project_id, $warehouse_id, $bank_account_id, $user_id);
				break;
			case EntityEnum::INVOICE->value:
				return self::exportInvoice($start_date, $end_date, $currency, $dept_id, $supplier_id, $project_id, $warehouse_id, $bank_account_id, $user_id);
				break;
			case EntityEnum::PAYMENT->value:
				return self::exportPayment($start_date, $end_date, $currency, $dept_id, $supplier_id, $project_id, $warehouse_id, $bank_account_id, $user_id);
				break;
			case EntityEnum::RECEIPT->value:
				return self::exportReceipt($start_date, $end_date, $currency, $dept_id, $supplier_id, $project_id, $warehouse_id, $bank_account_id, $user_id);
				break;
			case EntityEnum::AEL->value:
				return self::exportAel($start_date, $end_date, $currency, $dept_id, $supplier_id, $project_id, $warehouse_id, $bank_account_id, $user_id);
				break;
			default:
				Log::warning('tenant.export.run entity = '.$export->entity.' not found!');
		}
	}

	function increaseRunCounter($entity)
	{
		// Increase export run_count
		DB::statement("UPDATE exports SET
			run_count	= run_count + 1
			WHERE entity 	= '".$entity."'");
	}


	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreExportRequest $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Export $export)
	{
		$this->authorize('view', $export);

		return view('tenant.exports.show', compact('export'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Export $export)
	{
		$this->authorize('update', $export);

		return view('tenant.exports.edit', compact('export'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateExportRequest $request, Export $export)
	{
		$this->authorize('update', $export);

		// check box
		$request->merge(['article_id' => ($request->has('article_id') ? 1 : 0) ]);
		$request->merge(['article_id_required' => ($request->has('article_id_required') ? 1 : 0) ]);

		$request->merge(['start_date' => ($request->has('start_date') ? 1 : 0) ]);
		$request->merge(['start_date_required' => ($request->has('start_date_required') ? 1 : 0) ]);

		$request->merge(['end_date' => ($request->has('end_date') ? 1 : 0) ]);
		$request->merge(['end_date_required' => ($request->has('end_date_required') ? 1 : 0) ]);

		$request->merge(['user_id' => ($request->has('user_id') ? 1 : 0) ]);
		$request->merge(['user_id_required' => ($request->has('user_id_required') ? 1 : 0) ]);

		$request->merge(['item_id' => ($request->has('item_id') ? 1 : 0) ]);
		$request->merge(['item_id_required' => ($request->has('item_id_required') ? 1 : 0) ]);

		$request->merge(['supplier_id' => ($request->has('supplier_id') ? 1 : 0) ]);
		$request->merge(['supplier_id_required' => ($request->has('supplier_id_required') ? 1 : 0) ]);

		$request->merge(['project_id' => ($request->has('project_id') ? 1 : 0) ]);
		$request->merge(['project_id_required' => ($request->has('project_id_required') ? 1 : 0) ]);

		$request->merge(['category_id' => ($request->has('category_id') ? 1 : 0) ]);
		$request->merge(['category_id_required' => ($request->has('category_id_required') ? 1 : 0) ]);

		$request->merge(['dept_id' => ($request->has('dept_id') ? 1 : 0) ]);
		$request->merge(['dept_id_required' => ($request->has('dept_id_required') ? 1 : 0) ]);

		$request->merge(['warehouse_id' => ($request->has('warehouse_id') ? 1 : 0) ]);
		$request->merge(['warehouse_id_required' => ($request->has('warehouse_id_required') ? 1 : 0) ]);

		$export->update($request->all());

		// Write to Log
		EventLog::event('export', $export->id, 'update', 'name', $export->name);

		return redirect()->route('exports.index')->with('success', 'Export updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Export $export)
	{
		//
	}

	public function exportPr($start_date, $end_date, $currency, $dept_id, $supplier_id, $project_id, $warehouse_id, $bank_account_id, $user_id)
	{

		$this->authorize('pr', Export::class);

		$fileName = 'export-prs-' . date('Ymd') . '.xls';
		$prs = Pr::with('dept')->with('project')->with('supplier')->with('requestor')->with('user_created_by')->with('user_updated_by')->where('auth_status',AuthStatusEnum::APPROVED->value);

		// Filter based on input
		$prs->whereBetween('pr_date', [$start_date, $end_date ]);

		if ($currency <> ''){
			$prs->where('currency', $currency);
		}

		if ($dept_id <> ''){
			$prs->where('dept_id', $dept_id);
		}

		if ($supplier_id <> ''){
			$prs->where('supplier_id',$supplier_id);
		}

		if ($project_id <> ''){
			$prs->where('project_id',$project_id);
		}

		if ($user_id <> ''){
			$prs->where('requestor_id',$user_id);
		}

		// Seeded Filter
		// User sees only owned
		if (auth()->user()->role->value == UserRoleEnum::USER->value ){
			$prs->where('requestor_id',auth()->user()->id);
		}
		// HoD sees only dept
		if (auth()->user()->role->value == UserRoleEnum::HOD->value){
			$prs->where('dept_id', auth()->user()->dept_id);
		}
		$prs = $prs->get();

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		$sheet->setCellValue('A1', 'PR#');
		$sheet->setCellValue('B1', 'Summary');
		$sheet->setCellValue('C1', 'Date');
		$sheet->setCellValue('D1', 'need_by_date');
		$sheet->setCellValue('E1', 'Requestor');
		$sheet->setCellValue('F1', 'Dept');
		$sheet->setCellValue('G1', 'Project');
		$sheet->setCellValue('H1', 'Supplier_name');
		$sheet->setCellValue('I1', 'Notes');
		$sheet->setCellValue('J1', 'Currency');
		$sheet->setCellValue('K1', 'Sub_total');
		$sheet->setCellValue('L1', 'Tax');
		$sheet->setCellValue('M1', 'GST');
		$sheet->setCellValue('N1', 'Amount');
		$sheet->setCellValue('O1', 'Status');
		$sheet->setCellValue('P1', 'Auth_status');
		$sheet->setCellValue('Q1', 'Auth_date');
		// $sheet->setCellValue('R1', 'Created By');
		// $sheet->setCellValue('S1', 'Created At');
		// $sheet->setCellValue('T1', 'Updated By');
		// $sheet->setCellValue('U1', 'Updated At');

		$rows = 2;
		foreach($prs as $pr){
			$sheet->setCellValue('A' . $rows, $pr->id);
			$sheet->setCellValue('B' . $rows, $pr->summary);
			$sheet->setCellValue('C' . $rows, $pr->pr_date);
			$sheet->setCellValue('D' . $rows, $pr->need_by_date);
			$sheet->setCellValue('E' . $rows, $pr->requestor->name);
			$sheet->setCellValue('F' . $rows, $pr->dept->name);
			$sheet->setCellValue('G' . $rows, $pr->project->name);
			$sheet->setCellValue('H' . $rows, $pr->supplier->name);
			$sheet->setCellValue('I' . $rows, $pr->notes);
			$sheet->setCellValue('J' . $rows, $pr->currency);
			$sheet->setCellValue('K' . $rows, $pr->sub_total);
			$sheet->setCellValue('L' . $rows, $pr->tax);
			$sheet->setCellValue('M' . $rows, $pr->gst);
			$sheet->setCellValue('N' . $rows, $pr->amount);
			$sheet->setCellValue('O' . $rows, $pr->status);
			$sheet->setCellValue('P' . $rows, $pr->auth_status);
			$sheet->setCellValue('Q' . $rows, $pr->auth_date);
			// $sheet->setCellValue('R' . $rows, $pr->user_created_by->name);
			// $sheet->setCellValue('S' . $rows, $pr->created_at);
			// $sheet->setCellValue('T' . $rows, $pr->user_updated_by->name);
			// $sheet->setCellValue('U' . $rows, $pr->updated_at);
			$rows++;
		}

		$writer = new Xls($spreadsheet);
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
		$writer->save('php://output');

	}

	public function exportPrl($start_date, $end_date, $currency, $dept_id, $supplier_id, $project_id, $warehouse_id, $bank_account_id, $user_id)
	{

		$this->authorize('prl', Export::class);

		$fileName = 'export-prls-' . date('Ymd') . '.xls';
		$prls = Prl::with('item')->with('pr')->with('pr.dept')->with('pr.project')->with('pr.supplier')->with('pr.requestor')->with('user_created_by')->with('user_updated_by');
		$prls->whereHas('pr', function ($q) {
			$q->where('auth_status', AuthStatusEnum::APPROVED->value);
		});

		// Filter based on input
		$prls->whereHas('pr', function ($q) use ($start_date,$end_date)  {
			$q->whereBetween('pr_date', [$start_date, $end_date ]);
		});

		if ($currency <> ''){
			$prls->whereHas('pr', function ($q) use ($currency)  {
				$q->where('currency', $currency);
			});
		}

		if ($dept_id <> ''){
			$prls->whereHas('pr', function ($q) use ($dept_id)  {
				$q->where('dept_id', $dept_id);
			});
		}

		if ($supplier_id <> ''){
			$prls->whereHas('pr', function ($q) use ($supplier_id)  {
				$q->where('supplier_id',$supplier_id);
			});
		}

		if ($project_id <> ''){
			$prls->whereHas('pr', function ($q) use ($project_id) {
				$q->where('project_id',$project_id);
			});
		}

		if ($user_id <> ''){
			$prls->whereHas('pr', function ($q) use ($user_id) {
				$q->where('requestor_id',$user_id);
			});
		}

		// Seeded Filter
		// User sees only owned
		if (auth()->user()->role->value == UserRoleEnum::USER->value ){
			$prls->whereHas('pr', function ($q) {
				$q->where('requestor_id', auth()->user()->id);
			});

		}
		// HoD sees only dept
		if (auth()->user()->role->value == UserRoleEnum::HOD->value){
			$prls->whereHas('pr', function ($q) {
				$q->where('dept_id', auth()->user()->dept_id);
			});

		}
		$prls = $prls->get();

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		$sheet->setCellValue('A1', 'PR#');
		$sheet->setCellValue('B1', 'Summary');
		$sheet->setCellValue('C1', 'Date');
		$sheet->setCellValue('D1', 'Requestor');
		$sheet->setCellValue('E1', 'Dept');
		$sheet->setCellValue('F1', 'Project');
		$sheet->setCellValue('G1', 'Supplier');
		$sheet->setCellValue('H1', 'Currency');
		$sheet->setCellValue('I1', 'PR Amount');
		$sheet->setCellValue('J1', 'Status');
		$sheet->setCellValue('K1', 'Auth_status');
		$sheet->setCellValue('L1', 'Line#');
		$sheet->setCellValue('M1', 'Item Description');
		$sheet->setCellValue('N1', 'Code');
		$sheet->setCellValue('O1', 'UoM');
		$sheet->setCellValue('P1', 'Qty');
		$sheet->setCellValue('Q1', 'Price');
		$sheet->setCellValue('R1', 'Sub_total');
		$sheet->setCellValue('S1', 'Tax');
		$sheet->setCellValue('T1', 'GST');
		$sheet->setCellValue('U1', 'Amount');
		// $sheet->setCellValue('V1', 'Created By');
		// $sheet->setCellValue('W1', 'Created At');
		// $sheet->setCellValue('X1', 'Updated By');
		// $sheet->setCellValue('Y1', 'Updated At');

		$rows = 2;
		foreach($prls as $prl){
			$sheet->setCellValue('A' . $rows, $prl->id);
			$sheet->setCellValue('B' . $rows, $prl->pr->summary);
			$sheet->setCellValue('C' . $rows, $prl->pr->pr_date);
			$sheet->setCellValue('D' . $rows, $prl->pr->requestor->name);
			$sheet->setCellValue('E' . $rows, $prl->pr->dept->name);
			$sheet->setCellValue('F' . $rows, $prl->pr->project->name);
			$sheet->setCellValue('G' . $rows, $prl->pr->supplier->name);
			$sheet->setCellValue('H' . $rows, $prl->pr->currency);
			$sheet->setCellValue('I' . $rows, $prl->pr->amount);
			$sheet->setCellValue('J' . $rows, $prl->pr->status);
			$sheet->setCellValue('K' . $rows, $prl->pr->auth_status);
			$sheet->setCellValue('L' . $rows, $prl->line_num);
			$sheet->setCellValue('M' . $rows, $prl->item->name);
			$sheet->setCellValue('N' . $rows, $prl->item->code);
			$sheet->setCellValue('O' . $rows, $prl->uom->name);
			$sheet->setCellValue('P' . $rows, $prl->qty);
			$sheet->setCellValue('Q' . $rows, $prl->price);
			$sheet->setCellValue('R' . $rows, $prl->sub_total);
			$sheet->setCellValue('S' . $rows, $prl->tax);
			$sheet->setCellValue('T' . $rows, $prl->gst);
			$sheet->setCellValue('U' . $rows, $prl->amount);

			// $sheet->setCellValue('R' . $rows, $pr->user_created_by->name);
			// $sheet->setCellValue('S' . $rows, $pr->created_at);
			// $sheet->setCellValue('T' . $rows, $pr->user_updated_by->name);
			// $sheet->setCellValue('U' . $rows, $pr->updated_at);
			$rows++;
		}

		$writer = new Xls($spreadsheet);
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
		$writer->save('php://output');
	}

	public function exportPo($start_date, $end_date, $currency, $dept_id, $supplier_id, $project_id, $warehouse_id, $bank_account_id, $user_id)
	{

		$this->authorize('po', Export::class);

		$fileName = 'export-pos-' . date('Ymd') . '.xls';
		$pos = Po::with('dept')->with('project')->with('supplier')->with('requestor')->with('user_created_by')->with('user_updated_by')->where('auth_status',AuthStatusEnum::APPROVED->value);

		// Filter based on input
		$pos->whereBetween('pr_date', [$start_date, $end_date ]);

		if ($currency <> ''){
			$pos->where('currency', $currency);
		}

		if ($supplier_id <> null) {
			$pos->where('supplier_id', $supplier_id);
		}

		if ( $project_id <> null ) {
			$pos->where('project_id', $project_id);
		}

		if ( $user_id <> null ) {
			$pos->where('buyer_id', $user_id);
		}

		// Seeded Filter
		// HoD sees only dept
		if (auth()->user()->role->value == UserRoleEnum::HOD->value){
			$pos->where('dept_id',auth()->user()->dept_id);
		}
		$pos = $pos->get();

		// generate xls
		self::xlsAel($pos);

	}


	public function poForBuyer()
	{

		$this->authorize('po', Export::class);
		$pos = Po::with('dept')->with('project')->with('supplier')->with('requestor')->with('user_created_by')->with('user_updated_by')->where('auth_status',AuthStatusEnum::APPROVED->value);
		$pos->where('buyer_id', auth()->user()->id);

		$pos = $pos->get();
		// generate xls
		self::xlsPo($pos);

	}

	public function poForSupplier($supplierId)
	{
		$this->authorize('po', Export::class);
		$pos = Po::with('dept')->with('project')->with('supplier')->with('requestor')->with('user_created_by')->with('user_updated_by')->where('auth_status',AuthStatusEnum::APPROVED->value);
		if ( $supplierId <> null ) {
			$pos->where('supplier_id', $supplierId);
		}

		$pos = $pos->get();
		// generate xls
		self::xlsPo($pos);
	}

	public function poForProject($projectId)
	{
		$this->authorize('po', Export::class);
		$pos = Po::with('dept')->with('project')->with('supplier')->with('requestor')->with('user_created_by')->with('user_updated_by')->where('auth_status',AuthStatusEnum::APPROVED->value);
		if ( $projectId <> null ) {
			$pos->where('project_id', $projectId);
		}

		$pos = $pos->get();
		// generate xls
		self::xlsPo($pos);
	}


	public function xlsPo($pos) {

		$fileName = 'export-pos-' . date('Ymd') . '.xls';

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		$sheet->setCellValue('A1', 'PO#');
		$sheet->setCellValue('B1', 'Summary');
		$sheet->setCellValue('C1', 'Date');
		$sheet->setCellValue('D1', 'need_by_date');
		$sheet->setCellValue('E1', 'Requestor');
		$sheet->setCellValue('F1', 'Dept');
		$sheet->setCellValue('G1', 'Project');
		$sheet->setCellValue('H1', 'Supplier_name');
		$sheet->setCellValue('I1', 'Notes');
		$sheet->setCellValue('J1', 'Currency');
		$sheet->setCellValue('K1', 'Sub_total');
		$sheet->setCellValue('L1', 'Tax');
		$sheet->setCellValue('M1', 'GST');
		$sheet->setCellValue('N1', 'Amount');
		$sheet->setCellValue('O1', 'Status');
		$sheet->setCellValue('P1', 'Auth_status');
		$sheet->setCellValue('Q1', 'Auth_date');
		// $sheet->setCellValue('R1', 'Created By');
		// $sheet->setCellValue('S1', 'Created At');
		// $sheet->setCellValue('T1', 'Updated By');
		// $sheet->setCellValue('U1', 'Updated At');

		$rows = 2;
		foreach($pos as $po){
			$sheet->setCellValue('A' . $rows, $po->id);
			$sheet->setCellValue('B' . $rows, $po->summary);
			$sheet->setCellValue('C' . $rows, $po->po_date);
			$sheet->setCellValue('D' . $rows, $po->need_by_date);
			$sheet->setCellValue('E' . $rows, $po->requestor->name);
			$sheet->setCellValue('F' . $rows, $po->dept->name);
			$sheet->setCellValue('G' . $rows, $po->project->name);
			$sheet->setCellValue('H' . $rows, $po->supplier->name);
			$sheet->setCellValue('I' . $rows, $po->notes);
			$sheet->setCellValue('J' . $rows, $po->currency);
			$sheet->setCellValue('K' . $rows, $po->sub_total);
			$sheet->setCellValue('L' . $rows, $po->tax);
			$sheet->setCellValue('M' . $rows, $po->gst);
			$sheet->setCellValue('N' . $rows, $po->amount);
			$sheet->setCellValue('O' . $rows, $po->status);
			$sheet->setCellValue('P' . $rows, $po->auth_status);
			$sheet->setCellValue('Q' . $rows, $po->auth_date);
			// $sheet->setCellValue('R' . $rows, $pr->user_created_by->name);
			// $sheet->setCellValue('S' . $rows, $pr->created_at);
			// $sheet->setCellValue('T' . $rows, $pr->user_updated_by->name);
			// $sheet->setCellValue('U' . $rows, $pr->updated_at);
			$rows++;
		}

		$writer = new Xls($spreadsheet);
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
		$writer->save('php://output');

	}


	public function exportPol($start_date, $end_date, $currency, $dept_id, $supplier_id, $project_id, $warehouse_id, $bank_account_id, $user_id)
	{

		$this->authorize('pol', Export::class);

		$fileName = 'export-pols-' . date('Ymd') . '.xls';
		$pols = Pol::with('item')->with('po')->with('po.dept')->with('po.project')->with('po.supplier')->with('po.requestor')->with('user_created_by')->with('user_updated_by');
		$pols->whereHas('po', function ($q) {
			$q->where('auth_status', AuthStatusEnum::APPROVED->value);
		});


		// Filter based on input
		$pols->whereHas('po', function ($q) use ($start_date,$end_date)  {
			$q->whereBetween('po_date', [$start_date, $end_date ]);
		});

		if ($currency <> ''){
			$pols->whereHas('po', function ($q) use ($currency)  {
				$q->where('currency', $currency);
			});
		}

		if ($dept_id <> ''){
			$pols->whereHas('po', function ($q) use ($dept_id)  {
				$q->where('dept_id', $dept_id);
			});
		}

		if ($supplier_id <> ''){
			$pols->whereHas('po', function ($q) use ($supplier_id)  {
				$q->where('supplier_id', $supplier_id);
			});
		}

		if ($project_id <> ''){
			$pols->whereHas('po', function ($q) use ($project_id) {
				$q->where('project_id', $project_id);
			});
		}


		if ( $user_id <> null ) {
			$pols->whereHas('po', function ($q) use ($user_id) {
				$q->where('buyer_id', $user_id);
			});
		}

		// Seeded Filter
		// HoD sees only dept
		if (auth()->user()->role->value == UserRoleEnum::HOD->value){
			$pols->whereHas('po', function ($q) {
				$q->where('dept_id', auth()->user()->dept_id);
			});

		}
		$pols = $pols->get();

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		$sheet->setCellValue('A1', 'PO#');
		$sheet->setCellValue('B1', 'Summary');
		$sheet->setCellValue('C1', 'Date');
		$sheet->setCellValue('D1', 'Requestor');
		$sheet->setCellValue('E1', 'Dept');
		$sheet->setCellValue('F1', 'Project');
		$sheet->setCellValue('G1', 'Supplier');
		$sheet->setCellValue('H1', 'Currency');
		$sheet->setCellValue('I1', 'PO Amount');
		$sheet->setCellValue('J1', 'Status');
		$sheet->setCellValue('K1', 'Auth_status');
		$sheet->setCellValue('L1', 'Line#');
		$sheet->setCellValue('M1', 'Item Description');
		$sheet->setCellValue('N1', 'Code');
		$sheet->setCellValue('O1', 'UoM');
		$sheet->setCellValue('P1', 'Qty');
		$sheet->setCellValue('Q1', 'Price');
		$sheet->setCellValue('R1', 'Sub_total');
		$sheet->setCellValue('S1', 'Tax');
		$sheet->setCellValue('T1', 'GST');
		$sheet->setCellValue('U1', 'Amount');
		// $sheet->setCellValue('V1', 'Created By');
		// $sheet->setCellValue('W1', 'Created At');
		// $sheet->setCellValue('X1', 'Updated By');
		// $sheet->setCellValue('Y1', 'Updated At');

		$rows = 2;
		foreach($pols as $pol){
			$sheet->setCellValue('A' . $rows, $pol->id);
			$sheet->setCellValue('B' . $rows, $pol->po->summary);
			$sheet->setCellValue('C' . $rows, $pol->po->po_date);
			$sheet->setCellValue('D' . $rows, $pol->po->requestor->name);
			$sheet->setCellValue('E' . $rows, $pol->po->dept->name);
			$sheet->setCellValue('F' . $rows, $pol->po->project->name);
			$sheet->setCellValue('G' . $rows, $pol->po->supplier->name);
			$sheet->setCellValue('H' . $rows, $pol->po->currency);
			$sheet->setCellValue('I' . $rows, $pol->po->amount);
			$sheet->setCellValue('J' . $rows, $pol->po->status);
			$sheet->setCellValue('K' . $rows, $pol->po->auth_status);
			$sheet->setCellValue('L' . $rows, $pol->line_num);
			$sheet->setCellValue('M' . $rows, $pol->item->name);
			$sheet->setCellValue('N' . $rows, $pol->item->code);
			$sheet->setCellValue('O' . $rows, $pol->uom->name);
			$sheet->setCellValue('P' . $rows, $pol->qty);
			$sheet->setCellValue('Q' . $rows, $pol->price);
			$sheet->setCellValue('R' . $rows, $pol->sub_total);
			$sheet->setCellValue('S' . $rows, $pol->tax);
			$sheet->setCellValue('T' . $rows, $pol->gst);
			$sheet->setCellValue('U' . $rows, $pol->amount);

			// $sheet->setCellValue('R' . $rows, $pr->user_created_by->name);
			// $sheet->setCellValue('S' . $rows, $pr->created_at);
			// $sheet->setCellValue('T' . $rows, $pr->user_updated_by->name);
			// $sheet->setCellValue('U' . $rows, $pr->updated_at);
			$rows++;
		}

		$writer = new Xls($spreadsheet);
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
		$writer->save('php://output');
	}

	public function exportInvoice($start_date, $end_date, $currency, $dept_id, $supplier_id, $project_id, $warehouse_id, $bank_account_id, $user_id)
	{

		$this->authorize('invoice', Export::class);

		$fileName = 'export-invoices-' . date('Ymd') . '.xls';
		$invoices = Invoice::with('po')->with('po.dept')->with('po.project')->with('po.supplier')->with('po.requestor')->with('user_created_by')->with('user_updated_by');

		// $pols->whereHas('po', function ($q) {
		// 		$q->where('auth_status', AuthStatusEnum::APPROVED->value);
		// });


		// Filter based on input
		$invoices->whereBetween('invoice_date', [$start_date, $end_date ]);

		if ($currency <> ''){
			$invoices->where('currency', $currency);
		}

		// if ($dept_id <> ''){
		// 	$invoices->where('dept_id', $dept_id);
		// }

		if ($supplier_id <> ''){
			$invoices->where('supplier_id', $supplier_id);
		}

		// if ($project_id <> ''){
		// 	$invoices->where('project_id', $project_id);
		// }

		// if ($user_id <> ''){
		// 	$invoices->where('requestor_id', $user_id);
		// }

		// Seeded Filter
		// HoD sees only dept
		if (auth()->user()->role->value == UserRoleEnum::HOD->value){
			$invoices->whereHas('po', function ($q) {
				$q->where('dept_id', auth()->user()->dept_id);
			});

		}
		$invoices = $invoices->get();

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		//	i.fc_exchange_rate, i.fc_sub_total, i.fc_tax, i.fc_gst, i.fc_amount, i.fc_amount_paid,
		//	i.notes, i.status, i.payment_status
		$sheet->setCellValue('A1', 'ID#');
		$sheet->setCellValue('B1', 'Invoice No');
		$sheet->setCellValue('C1', 'Date');
		$sheet->setCellValue('D1', 'PO#');
		$sheet->setCellValue('E1', 'PO Summary');
		$sheet->setCellValue('F1', 'Supplier');
		$sheet->setCellValue('G1', 'PoC Name');
		$sheet->setCellValue('H1', 'Currency');
		$sheet->setCellValue('I1', 'Sub_total');
		$sheet->setCellValue('J1', 'Tax');
		$sheet->setCellValue('K1', 'GST');
		$sheet->setCellValue('L1', 'Amount');
		$sheet->setCellValue('M1', 'Paid Amount');
		$sheet->setCellValue('N1', 'Notes');
		$sheet->setCellValue('O1', 'Status');
		// $sheet->setCellValue('V1', 'Created By');
		// $sheet->setCellValue('W1', 'Created At');
		// $sheet->setCellValue('X1', 'Updated By');
		// $sheet->setCellValue('Y1', 'Updated At');

		$rows = 2;
		foreach($invoices as $invoice){
			$sheet->setCellValue('A' . $rows, $invoice->id);
			$sheet->setCellValue('B' . $rows, $invoice->invoice_no);
			$sheet->setCellValue('C' . $rows, $invoice->invoice_date);
			$sheet->setCellValue('D' . $rows, $invoice->po->id);
			$sheet->setCellValue('E' . $rows, $invoice->po->summary);
			$sheet->setCellValue('F' . $rows, $invoice->po->supplier->name);
			$sheet->setCellValue('G' . $rows, $invoice->poc->name);

			$sheet->setCellValue('H' . $rows, $invoice->currency);
			$sheet->setCellValue('I' . $rows, $invoice->sub_total);
			$sheet->setCellValue('J' . $rows, $invoice->tax);
			$sheet->setCellValue('K' . $rows, $invoice->gst);
			$sheet->setCellValue('L' . $rows, $invoice->amount);
			$sheet->setCellValue('M' . $rows, $invoice->amount_paid);
			$sheet->setCellValue('N' . $rows, $invoice->notes);
			$sheet->setCellValue('O' . $rows, $invoice->status);

			// $sheet->setCellValue('R' . $rows, $pr->user_created_by->name);
			// $sheet->setCellValue('S' . $rows, $pr->created_at);
			// $sheet->setCellValue('T' . $rows, $pr->user_updated_by->name);
			// $sheet->setCellValue('U' . $rows, $pr->updated_at);
			$rows++;
		}

		$writer = new Xls($spreadsheet);
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
		$writer->save('php://output');

	}


	public function exportPayment($start_date, $end_date, $currency, $dept_id, $supplier_id, $project_id, $warehouse_id, $bank_account_id, $user_id)
	{

		$this->authorize('payment', Export::class);

		$fileName = 'export-payments-' . date('Ymd') . '.xls';
		$payments = Payment::with('bank_account')->with('payee')->with('invoice')->with('invoice.supplier')->with('user_created_by')->with('user_updated_by');

		// Filter based on input
		$payments->whereBetween('pay_date', [$start_date, $end_date ]);

		if ($currency <> ''){
			$payments->where('currency', $currency);
		}

		// if ($dept_id <> ''){
		// 	$payments->where('dept_id', $dept_id);
		// }

		// if ($supplier_id <> ''){
		// 	$payments->where('supplier_id', $supplier_id);
		// }

		if ($bank_account_id <> ''){
			$payments->where('bank_account_id', $bank_account_id);
		}

		// if ($project_id <> ''){
		// 	$payments->where('project_id', $project_id);
		// }

		// if ($user_id <> ''){
		// 	$payments->where('payee_id', $user_id);
		// }

		// Seeded Filter
		// HoD sees only dept
		if (auth()->user()->role->value == UserRoleEnum::HOD->value){
			$payments->whereHas('invoice.po', function ($q) {
				$q->where('dept_id', auth()->user()->dept_id);
			});

		}
		$payments = $payments->get();

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		$sheet->setCellValue('A1', 'PAY#');
		$sheet->setCellValue('B1', 'Date');
		$sheet->setCellValue('C1', 'Narration');
		$sheet->setCellValue('D1', 'Supplier');
		$sheet->setCellValue('E1', 'Bank Ac');
		$sheet->setCellValue('F1', 'Cheque No');
		$sheet->setCellValue('G1', 'Currency');
		$sheet->setCellValue('H1', 'Amount');
		$sheet->setCellValue('I1', 'Payee');
		$sheet->setCellValue('J1', 'Invoice Num');
		$sheet->setCellValue('J1', 'Invoice Date');
		$sheet->setCellValue('K1', 'PO#');
		// $sheet->setCellValue('V1', 'Created By');
		// $sheet->setCellValue('W1', 'Created At');
		// $sheet->setCellValue('X1', 'Updated By');
		// $sheet->setCellValue('Y1', 'Updated At');

		$rows = 2;
		foreach($payments as $payment){
			$sheet->setCellValue('A' . $rows, $payment->id);
			$sheet->setCellValue('B' . $rows, $payment->pay_date);
			$sheet->setCellValue('C' . $rows, $payment->summary);
			$sheet->setCellValue('D' . $rows, $payment->invoice->supplier->name);
			$sheet->setCellValue('E' . $rows, $payment->bank_account->name);
			$sheet->setCellValue('F' . $rows, $payment->cheque_no);
			$sheet->setCellValue('G' . $rows, $payment->currency);
			$sheet->setCellValue('H' . $rows, $payment->amount);
			$sheet->setCellValue('I' . $rows, $payment->payee->name);
			$sheet->setCellValue('J' . $rows, $payment->invoice->invoice_no);
			$sheet->setCellValue('J' . $rows, $payment->invoice->invoice_date);
			$sheet->setCellValue('K' . $rows, $payment->po_id);
			// $sheet->setCellValue('R' . $rows, $pr->user_created_by->name);
			// $sheet->setCellValue('S' . $rows, $pr->created_at);
			// $sheet->setCellValue('T' . $rows, $pr->user_updated_by->name);
			// $sheet->setCellValue('U' . $rows, $pr->updated_at);
			$rows++;
		}

		$writer = new Xls($spreadsheet);
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
		$writer->save('php://output');

	}

	public function exportReceipt($start_date, $end_date, $currency, $dept_id, $supplier_id, $project_id, $warehouse_id, $bank_account_id, $user_id)
	{

		$this->authorize('receipt', Export::class);

		$fileName = 'export-receipts-' . date('Ymd') . '.xls';
		$receipts = Receipt::with('pol')->with('pol.po')->with('pol.po.dept')->with('pol.uom')->with('warehouse')->with('user_created_by')->with('user_updated_by');

		// Filter based on input
		$receipts->whereBetween('receive_date', [$start_date, $end_date ]);

		if ($currency <> ''){
			$receipts->where('currency', $currency);
		}

		if ($dept_id <> ''){
			$receipts->where('dept_id', $dept_id);
		}

		if ($supplier_id <> ''){
			$receipts->where('supplier_id', $supplier_id);
		}

		if ($project_id <> ''){
			$receipts->where('project_id', $project_id);
		}

		if ($warehouse_id <> ''){
			$receipts->where('warehouse_id', $warehouse_id);
		}

		if ($user_id <> ''){
			$receipts->where('requestor_id', $user_id);
		}

		// Seeded Filter
		// HoD sees only dept
		if (auth()->user()->role->value == UserRoleEnum::HOD->value){
			$receipts->whereHas('pol.po', function ($q) {
				$q->where('dept_id', auth()->user()->dept_id);
			});

		}
		$receipts = $receipts->get();

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		$sheet->setCellValue('A1', 'RECEIPT#');
		$sheet->setCellValue('B1', 'Date');
		$sheet->setCellValue('C1', 'Item Description');
		$sheet->setCellValue('D1', 'Qty');
		$sheet->setCellValue('E1', 'UoM');
		$sheet->setCellValue('F1', 'Warehouse');
		$sheet->setCellValue('G1', 'Receiver');
		$sheet->setCellValue('H1', 'Notes');
		$sheet->setCellValue('I1', 'PO#');
		$sheet->setCellValue('J1', 'PO Line Num');
		// $sheet->setCellValue('V1', 'Created By');
		// $sheet->setCellValue('W1', 'Created At');
		// $sheet->setCellValue('X1', 'Updated By');
		// $sheet->setCellValue('Y1', 'Updated At');

		$rows = 2;
		foreach($receipts as $receipt){
			$sheet->setCellValue('A' . $rows, $receipt->id);
			$sheet->setCellValue('B' . $rows, $receipt->receive_date);
			$sheet->setCellValue('C' . $rows, $receipt->pol->item_description);
			$sheet->setCellValue('D' . $rows, $receipt->qty);
			$sheet->setCellValue('E' . $rows, $receipt->pol->uom->name);
			$sheet->setCellValue('F' . $rows, $receipt->warehouse->name);
			$sheet->setCellValue('G' . $rows, $receipt->receiver->name);
			$sheet->setCellValue('H' . $rows, $receipt->notes);
			$sheet->setCellValue('I' . $rows, $receipt->pol->po_id);
			$sheet->setCellValue('J' . $rows, $receipt->pol->line_num);

			// $sheet->setCellValue('R' . $rows, $pr->user_created_by->name);
			// $sheet->setCellValue('S' . $rows, $pr->created_at);
			// $sheet->setCellValue('T' . $rows, $pr->user_updated_by->name);
			// $sheet->setCellValue('U' . $rows, $pr->updated_at);
			$rows++;
		}

		$writer = new Xls($spreadsheet);
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
		$writer->save('php://output');
	}


	public function exportAel($start_date, $end_date, $currency, $dept_id, $supplier_id, $project_id, $warehouse_id, $bank_account_id, $user_id)
	{

		$this->authorize('ael', Export::class);

		$aels = Ael::with('aeh')->with('user_created_by')->with('user_updated_by');

		// Filter based on input
		$aels->whereBetween('accounting_date', [$start_date, $end_date ]);

		$aels = $aels->get();
		// generate xls
		self::xlsAel($aels);

	}

	public function aelForPo($po_id)
	{
		$this->authorize('ael', Export::class);

		$aels = Ael::with('aeh')->with('user_created_by')->with('user_updated_by');

		// Filter based on input
		$aels->whereHas('aeh', function ($q) use ($po_id)  {
			$q->where('po_id', $po_id);
		});

		$aels = $aels->get();
		// generate xls
		self::xlsAel($aels);

	}

	public function aelForInvoice($invoiceId)
	{
		$this->authorize('ael', Export::class);

		$aels = Ael::with('aeh')->with('user_created_by')->with('user_updated_by')->ByInvoice($invoiceId);
		// Filter based on input

		$aels = $aels->get();
		// generate xls
		self::xlsAel($aels);
	}

	public function aelForPayment($paymentId)
	{
		$this->authorize('ael', Export::class);

		$aels = Ael::with('aeh')->with('user_created_by')->with('user_updated_by')->ByPayment($paymentId);
		// Filter based on input

		$aels = $aels->get();
		// generate xls
		self::xlsAel($aels);
	}


	public function aelForReceipt($receiptId)
	{
		$this->authorize('ael', Export::class);

		$aels = Ael::with('aeh')->with('user_created_by')->with('user_updated_by')->ByReceipt($receiptId);
		// Filter based on input

		$aels = $aels->get();
		// generate xls
		self::xlsAel($aels);
	}

	public function aelForAeh($aeh_id)
	{
		$this->authorize('ael', Export::class);
		$aels = Ael::with('aeh')->with('user_created_by')->with('user_updated_by');
		// Filter based on input
		if ($aeh_id <> ''){
			$aels->where('aeh_id', $aeh_id);
		}
		$aels = $aels->get();
		// generate xls
		self::xlsAel($aels);
	}

	public function xlsAel( $aels)
	{
		$fileName = 'export-aels-' . date('Ymd') . '.xls';

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		$sheet->setCellValue('A1', 'AEL#');
		$sheet->setCellValue('B1', 'Source');
		$sheet->setCellValue('C1', 'Entity');
		$sheet->setCellValue('D1', 'Event');
		$sheet->setCellValue('E1', 'Line Num');
		$sheet->setCellValue('F1', 'Date');
		$sheet->setCellValue('G1', 'AC Code');
		$sheet->setCellValue('H1', 'Line Desc');
		$sheet->setCellValue('I1', 'Currency');
		$sheet->setCellValue('J1', 'Dr');
		$sheet->setCellValue('K1', 'Cr');
		$sheet->setCellValue('L1', 'PO#');
		$sheet->setCellValue('M1', 'Reference');
		// $sheet->setCellValue('R1', 'Created By');
		// $sheet->setCellValue('S1', 'Created At');
		// $sheet->setCellValue('T1', 'Updated By');
		// $sheet->setCellValue('U1', 'Updated At');

		$rows = 2;
		foreach($aels as $ael){
			$sheet->setCellValue('A' . $rows, $ael->id);
			$sheet->setCellValue('B' . $rows, $ael->aeh->source_app);
			$sheet->setCellValue('C' . $rows, $ael->aeh->source_entity->value);
			$sheet->setCellValue('D' . $rows, $ael->aeh->event->value);
			$sheet->setCellValue('E' . $rows, $ael->line_num);
			$sheet->setCellValue('F' . $rows, $ael->accounting_date);
			$sheet->setCellValue('G' . $rows, $ael->ac_code);
			$sheet->setCellValue('H' . $rows, $ael->line_description);
			$sheet->setCellValue('I' . $rows, $ael->fc_currency);
			$sheet->setCellValue('J' . $rows, $ael->fc_dr_amount);
			$sheet->setCellValue('K' . $rows, $ael->fc_cr_amount);
			$sheet->setCellValue('L' . $rows, $ael->aeh->po_i);
			$sheet->setCellValue('M' . $rows, $ael->reference_no);
			// $sheet->setCellValue('R' . $rows, $pr->user_created_by->name);
			// $sheet->setCellValue('S' . $rows, $pr->created_at);
			// $sheet->setCellValue('T' . $rows, $pr->user_updated_by->name);
			// $sheet->setCellValue('U' . $rows, $pr->updated_at);
			$rows++;
		}

		$writer = new Xls($spreadsheet);
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
		$writer->save('php://output');
	}

	public function exportBudget($revision = null, $parent = null)
	{

		$this->authorize('budget', Export::class);
		$setup = Setup::first();

		if(empty($revision)){
			$fileName = 'export-budgets-' . date('Ymd') . '.xls';
			$budgets = Budget::where('revision', false);
		} else {
			$fileName = 'export-budget-revisions-all' . date('Ymd') . '.xls';
			$budgets = Budget::where('revision', true);
		}

		if(!empty($parent)){
			$fileName = 'export-budget-revision-' . date('Ymd') . '.xls';
			$budgets = Budget::where('revision', true);
			$budgets->where('parent_id', $parent);
		}

		$budgets = $budgets->get();

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		$sheet->setCellValue('A1', 'ID#');
		$sheet->setCellValue('B1', 'FY');
		$sheet->setCellValue('C1', 'Name');
		$sheet->setCellValue('D1', 'Start Date');
		$sheet->setCellValue('E1', 'End Date');
		$sheet->setCellValue('F1', 'Currency');
		$sheet->setCellValue('G1', 'Amount');
		$sheet->setCellValue('H1', 'Amount PR Booked');
		$sheet->setCellValue('I1', 'Amount PR');
		$sheet->setCellValue('J1', 'Amount PO Booked');
		$sheet->setCellValue('K1', 'Amount Po');
		$sheet->setCellValue('L1', 'Amount Grs');
		$sheet->setCellValue('M1', 'Amount Invoice');
		$sheet->setCellValue('N1', 'Amount Payment');
		$sheet->setCellValue('O1', 'Revision');
		$sheet->setCellValue('P1', 'Closed');
		$sheet->setCellValue('Q1', 'Notes');
		// $sheet->setCellValue('V1', 'Created By');
		// $sheet->setCellValue('W1', 'Created At');
		// $sheet->setCellValue('X1', 'Updated By');
		// $sheet->setCellValue('Y1', 'Updated At');

		$rows = 2;
		foreach($budgets as $budget){
			$sheet->setCellValue('A' . $rows, $budget->id);
			$sheet->setCellValue('B' . $rows, $budget->fy);
			$sheet->setCellValue('C' . $rows, $budget->name);
			$sheet->setCellValue('D' . $rows, $budget->start_date);
			$sheet->setCellValue('E' . $rows, $budget->end_date);
			$sheet->setCellValue('F' . $rows, $setup->currency);
			$sheet->setCellValue('G' . $rows, $budget->amount);
			$sheet->setCellValue('H' . $rows, $budget->amount_pr_booked);
			$sheet->setCellValue('I' . $rows, $budget->amount_pr);
			$sheet->setCellValue('J' . $rows, $budget->amount_po_booked);
			$sheet->setCellValue('K' . $rows, $budget->amount_po);
			$sheet->setCellValue('L' . $rows, $budget->amount_grs);
			$sheet->setCellValue('M' . $rows, $budget->amount_invoice);
			$sheet->setCellValue('N' . $rows, $budget->amount_payment);
			$sheet->setCellValue('O' . $rows, $budget->revision == 1 ? "Yes" : "No" );
			$sheet->setCellValue('P' . $rows, $budget->closed == 1 ? "Yes" : "No" );
			$sheet->setCellValue('Q' . $rows, $budget->notes);
			// $sheet->setCellValue('R' . $rows, $pr->user_created_by->name);
			// $sheet->setCellValue('S' . $rows, $pr->created_at);
			// $sheet->setCellValue('T' . $rows, $pr->user_updated_by->name);
			// $sheet->setCellValue('U' . $rows, $pr->updated_at);
			$rows++;
		}

		$writer = new Xls($spreadsheet);
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
		$writer->save('php://output');
	}


	public function exportDeptBudget($revision = null, $parent = null)
	{

		$this->authorize('deptBudget', Export::class);
		$setup 				= Setup::first();

		if(empty($revision)){
			$fileName 		= 'export-dept-budgets-' . date('Ymd') . '.xls';
			$deptBudgets 	= DeptBudget::with('budget')->with('dept')->where('revision', false);
		} else {
			$fileName 		= 'export-dept-budget-revisions-all' . date('Ymd') . '.xls';
			$deptBudgets 	= DeptBudget::with('budget')->with('dept')->where('revision', true);
		}

		if(!empty($parent)){
			$fileName 		= 'export-dept-budget-revision-' . date('Ymd') . '.xls';
			$deptBudgets 	= DeptBudget::with('budget')->with('dept')->where('revision', true);
			$deptBudgets->where('parent_id', $parent);
		}

		$deptBudgets 		= $deptBudgets->get();

		$spreadsheet 		= new Spreadsheet();
		$sheet 				= $spreadsheet->getActiveSheet();

		$sheet->setCellValue('A1', 'ID#');
		$sheet->setCellValue('B1', 'FY');
		$sheet->setCellValue('C1', 'Name');
		$sheet->setCellValue('D1', 'Start Date');
		$sheet->setCellValue('E1', 'End Date');
		$sheet->setCellValue('F1', 'Currency');
		$sheet->setCellValue('G1', 'Dept');
		$sheet->setCellValue('H1', 'Amount');
		$sheet->setCellValue('I1', 'Amount PR Booked');
		$sheet->setCellValue('J1', 'Amount PR');
		$sheet->setCellValue('K1', 'Amount PO Booked');
		$sheet->setCellValue('L1', 'Amount Po');
		$sheet->setCellValue('M1', 'Amount Grs');
		$sheet->setCellValue('N1', 'Amount Invoice');
		$sheet->setCellValue('O1', 'Amount Payment');
		$sheet->setCellValue('P1', 'Revision');
		$sheet->setCellValue('Q1', 'Closed');
		$sheet->setCellValue('R1', 'Notes');
		// $sheet->setCellValue('V1', 'Created By');
		// $sheet->setCellValue('W1', 'Created At');
		// $sheet->setCellValue('X1', 'Updated By');
		// $sheet->setCellValue('Y1', 'Updated At');

		$rows = 2;
		foreach($deptBudgets as $deptBudget){
			$sheet->setCellValue('A' . $rows, $deptBudget->id);
			$sheet->setCellValue('B' . $rows, $deptBudget->budget->fy);
			$sheet->setCellValue('C' . $rows, $deptBudget->budget->name);
			$sheet->setCellValue('D' . $rows, $deptBudget->budget->start_date);
			$sheet->setCellValue('E' . $rows, $deptBudget->budget->end_date);
			$sheet->setCellValue('F' . $rows, $setup->currency);
			$sheet->setCellValue('G' . $rows, $deptBudget->dept->name);
			$sheet->setCellValue('H' . $rows, $deptBudget->amount);
			$sheet->setCellValue('I' . $rows, $deptBudget->amount_pr_booked);
			$sheet->setCellValue('J' . $rows, $deptBudget->amount_pr);
			$sheet->setCellValue('K' . $rows, $deptBudget->amount_po_booked);
			$sheet->setCellValue('L' . $rows, $deptBudget->amount_po);
			$sheet->setCellValue('M' . $rows, $deptBudget->amount_grs);
			$sheet->setCellValue('N' . $rows, $deptBudget->amount_invoice);
			$sheet->setCellValue('O' . $rows, $deptBudget->amount_payment);
			$sheet->setCellValue('P' . $rows, $deptBudget->revision == 1 ? "Yes" : "No" );
			$sheet->setCellValue('Q' . $rows, $deptBudget->closed == 1 ? "Yes" : "No" );
			$sheet->setCellValue('R' . $rows, $deptBudget->notes);
			// $sheet->setCellValue('R' . $rows, $pr->user_created_by->name);
			// $sheet->setCellValue('S' . $rows, $pr->created_at);
			// $sheet->setCellValue('T' . $rows, $pr->user_updated_by->name);
			// $sheet->setCellValue('U' . $rows, $pr->updated_at);
			$rows++;
		}

		$writer = new Xls($spreadsheet);
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
		$writer->save('php://output');
	}
}
