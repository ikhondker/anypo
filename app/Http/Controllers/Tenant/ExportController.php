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

use App\Models\Tenant\Lookup\Dept;
use App\Models\Tenant\Lookup\Project;
use App\Models\Tenant\Lookup\Warehouse;
use App\Models\Tenant\Lookup\Supplier;
use App\Models\Tenant\Lookup\BankAccount;

use App\Models\Tenant\Admin\Setup;
# 2. Enums
use App\Enum\Tenant\EntityEnum;
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
		if(auth()->user()->role->value == UserRoleEnum::SYSTEM->value) {
			$exports = $exports->orderBy('order_by1', 'ASC')->orderBy('order_by2', 'ASC')->paginate(100);
			return view('tenant.exports.all', compact('exports'));
		} else {
			$exports = $exports->where('enable', true)->orderBy('order_by1', 'ASC')->orderBy('order_by2', 'ASC')->paginate(100);
			return view('tenant.exports.index', compact('exports'));
		}
	}

    public function pr()
	{
        Log::debug('I AM HERE');
       //self::parameter(Str::lower(EntityEnum::PR->value));
       self::parameter(EntityEnum::PR->value);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function parameter($entity)
	{
        Log::debug('I AM HERE before');
        $export         = Export::where('entity', $entity)->firstOrFail();
        Log::debug('I AM HERE after');
		$depts 			= Dept::Primary()->get();
		$suppliers 		= Supplier::Primary()->get();
		$projects 		= Project::Primary()->get();
		$warehouses 	= Warehouse::Primary()->get();
		$bank_accounts 	= BankAccount::Primary()->get();
		$pms 			= User::Tenant()->get();
		return view('tenant.exports.parameters', compact('export','depts','suppliers','projects','warehouses','bank_accounts','pms'));
	}


	/**
	 * Update the specified resource in storage.
	 */
	public function run(UpdateExportRequest $request, Export $export)
	{

		//$report_id		= $request->input('report_id');
		$article_id			= $request->input('article_id');
		$start_date			= $request->input('start_date');
		$end_date			= $request->input('end_date');
		$dept_id			= $request->input('dept_id');
		$supplier_id		= $request->input('supplier_id');
		$project_id			= $request->input('project_id');
		$warehouse_id		= $request->input('warehouse_id');
		$bank_account_id	= $request->input('bank_account_id');
		$pm_id				= $request->input('pm_id');

		Log::debug('tenant.export.run article_id = '.$article_id);
		Log::debug('tenant.export.run start_date = '.$start_date);
		Log::debug('tenant.export.run end_date = '.$end_date);
		Log::debug('tenant.export.run pm_id = '.$pm_id);

		Log::debug('tenant.export.run entity = '.$export->entity);

		// Increase exports run_count -------------------------
		self::increaseRunCounter(Str::lower($export->entity));

		// article_id validation
		if ($export->article_id_required){
			try {
				switch ($export->entity) {
					case EntityEnum::PR->value:
						$pr = Pr::where('id', $article_id)->firstOrFail();
						break;
					case EntityEnum::PO->value:
						$po = Po::where('id', $article_id)->firstOrFail();
						break;
					case EntityEnum::INVOICE->value:
						$invoice = Invoice::where('id', $article_id)->firstOrFail();
						break;
					case EntityEnum::PAYMENT->value:
						$payment = Payment::where('id', $article_id)->firstOrFail();
						break;
					case EntityEnum::RECEIPT->value:
						$receipt = Receipt::where('id', $article_id)->firstOrFail();
						break;
					default:
						Log::error(tenant('id'). 'tenant.ReportController.run entity = '.$export->entity.' article_id = ' . $article_id);
						return redirect()->back()->with('error', 'Unknown Error!');
				}
			} catch (ModelNotFoundException $exception) {
				throw ValidationException::withMessages(['article_id' => $export->entity.' ID #'.$article_id.' not found!']);
			}
		}


		switch ($export->entity) {
			case EntityEnum::PR->value:
			case EntityEnum::PRL->value:
				return self::pr($start_date, $end_date, $dept_id);
				break;
			case 'prlist':
				return self::prlist($start_date, $end_date, $dept_id);
				break;
			case EntityEnum::POL->value:
				return self::prllist($start_date, $end_date, $dept_id);
				break;
			case EntityEnum::PO->value:
				return self::po($article_id);
				break;
			case 'polist':
				return self::polist($start_date, $end_date, $dept_id);
				break;
			case 'pollist':
				return self::pollist($start_date, $end_date, $dept_id);
				break;

				case EntityEnum::INVOICE->value:
					return self::invoice($article_id);
					break;
			case 'invoicelist':
				return self::invoicelist($start_date, $end_date, $dept_id);
				break;

				case EntityEnum::PAYMENT->value:
					return self::payment($article_id);
					break;
			case 'paymentlist':
				return self::paymentlist($start_date, $end_date, $dept_id);
				break;

				case EntityEnum::RECEIPT->value:
					return self::receipt($article_id);
					break;
			case 'receiptlist':
					return self::receiptlist($start_date, $end_date, $dept_id);
					break;
			case 'projectspend':
				return self::projectspend($start_date, $end_date, $project_id);
				break;

			case 'supplierspend':
				return self::supplierspend($start_date, $end_date, $supplier_id);
				break;

			case 'taxregister':
				return self::taxregister($start_date, $end_date, $dept_id);
				break;

			case 'aellist':
				return self::aellist($start_date, $end_date);
				break;

			default:
				Log::warning(tenant('id').' tenant.export.run entity = '.$export->entity.' not found!');
		}
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

	public function exportPr($start_date, $end_date, $dept_id)
	{


		$this->authorize('pr', Export::class);

		$fileName = 'export-prs-' . date('Ymd') . '.xls';
		$prs = Pr::with('dept')->with('project')->with('supplier')->with('requestor')->with('user_created_by')->with('user_updated_by')->where('auth_status',AuthStatusEnum::APPROVED->value);
		$prs->whereBetween('pr_date', [$start_date, $end_date ]);

		if ($dept_id <> ''){
			$prs->where('dept_id',$dept_id);
		}

		// User sees only owned
		if (auth()->user()->role->value == UserRoleEnum::USER->value ){
			$prs->where('requestor_id',auth()->user()->id);
		}
		// HoD sees only dept
		if (auth()->user()->role->value == UserRoleEnum::HOD->value){
			$prs->where('dept_id',auth()->user()->dept_id);
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

	function increaseRunCounter($entity)
	{
		// Increase export run_count
		DB::statement("UPDATE exports SET
			run_count	= run_count + 1
			WHERE entity 	= '".$entity."'");
	}


}
