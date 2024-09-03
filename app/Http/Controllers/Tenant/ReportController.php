<?php

/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			ReportController.php
* @brief		This file contains the implementation of the ReportController
* @path			\App\Http\Controllers\Tenant
* @author		Iqbal H. Khondker <ihk@khondker.com>
* @created		4-JAN-2024
* @copyright	(c) Iqbal H. Khondker <ihk@khondker.com>
* =====================================================================================
* Revision History:
* Date			Version	Author				Comments
* -------------------------------------------------------------------------------------
* 4-JAN-2024	v1.0	Iqbal H Khondker	Created
* DD-MON-YYYY	v1.1	Iqbal H Khondker	Modification brief
* =====================================================================================
*/
// https://laracasts.com/discuss/channels/laravel/how-to-display-footer-on-all-pages-in-laravel-generated-pdf
// https://ourcodeworld.com/articles/read/687/how-to-configure-a-header-and-footer-in-dompdf

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;


use App\Models\Tenant\Report;
use App\Http\Requests\Tenant\StoreReportRequest;
use App\Http\Requests\Tenant\UpdateReportRequest;

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
use App\Enum\EntityEnum;
use App\Enum\UserRoleEnum;
use App\Enum\AuthStatusEnum;
use App\Enum\InvoiceStatusEnum;
# 3. Helpers
use App\Helpers\Export;
use App\Helpers\EventLog;
# 4. Notifications
# 5. Jobs
# 6. Mails
# 7. Rules
# 8. Packages
use PDF;
# 9. Exceptions
# 10. Events
# 11. Controller
# 12. Seeded
use DB;
use Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

# 13. FUTURE
# 1 . Add entity column in reports.index

class ReportController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{

		$this->authorize('viewAny',Report::class);

		$reports = Report::query();
		if (request('term')) {
			$reports->where('name', 'Like', '%'.request('term').'%');
		}
		if(auth()->user()->role->value == UserRoleEnum::SYSTEM->value) {
			$reports = $reports->orderBy('order_by1', 'ASC')->orderBy('order_by2', 'ASC')->paginate(100);
			return view('tenant.reports.all', compact('reports'));
		} else {
			$reports = $reports->where('enable', true)->orderBy('order_by1', 'ASC')->orderBy('order_by2', 'ASC')->paginate(100);
			return view('tenant.reports.index', compact('reports'));
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function parameter(Report $report)
	{
		$depts 			= Dept::Primary()->get();
		$suppliers 		= Supplier::Primary()->get();
		$projects 		= Project::Primary()->get();
		$warehouses 	= Warehouse::Primary()->get();
		$bank_accounts 	= BankAccount::Primary()->get();
		$pms 			= User::Tenant()->get();
		//$report_id='1003';
		return view('tenant.reports.parameters', compact('report','depts','suppliers','projects','warehouses','bank_accounts','pms'));
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
	public function store(StoreReportRequest $request)
	{


	}

	/**
	 * Display the specified resource.
	 */
	public function show(Report $report)
	{
		$this->authorize('view', $report);

		return view('tenant.reports.show', compact('report'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Report $report)
	{
		$this->authorize('update', $report);

		return view('tenant.reports.edit', compact('report'));
		//$pms = User::Tenant()->get();
		//$report_id='1003';
		//return view('tenant.reports.parameters', compact('report','pms'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function run(UpdateReportRequest $request, Report $report)
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

		Log::debug('tenant.report.run article_id = '.$article_id);
		Log::debug('tenant.report.run start_date = '.$start_date);
		Log::debug('tenant.report.run end_date = '.$end_date);
		Log::debug('tenant.report.run pm_id = '.$pm_id);
		
		Log::debug('tenant.report.run report_code = '.$report->code);

		// Increase reports run_count -------------------------
		self::increaseRunCounter(Str::lower($report->code));
		

		// article_id validation
		if ($report->article_id_required){
			try {
				switch ($report->entity) {
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
						Log::error(tenant('id'). 'tenant.ReportController.run entity = '.$report->entity.' article_id = ' . $article_id);
						return redirect()->back()->with('error', 'Unknown Error!');
				}
			} catch (ModelNotFoundException $exception) {
				//} catch (Exception $e) {
				throw ValidationException::withMessages(['article_id' => $report->entity.' ID #'.$article_id.' not found!']);
			}
		}


		switch ($report->code) {
			case 'pr':
				return self::pr($article_id);
				break;
			case 'prlist':
				return self::prlist($start_date, $end_date, $dept_id);
				break;
			case 'prllist':
				return self::prllist($start_date, $end_date, $dept_id);
				break;

			case 'po':
					return self::po($article_id);
					break;
			case 'polist':
				return self::polist($start_date, $end_date, $dept_id);
				break;
			case 'pollist':
				return self::pollist($start_date, $end_date, $dept_id);
				break;

			case 'invoice':
					return self::invoice($article_id);
					break;
			case 'invoicelist':
				return self::invoicelist($start_date, $end_date, $dept_id);
				break;

			case 'payment':
					return self::payment($article_id);
					break;
			case 'paymentlist':
				return self::paymentlist($start_date, $end_date, $dept_id);
				break;

			case 'receipt':
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
				Log::warning(tenant('id').' tenant.report.run report_id = '.$report->id.' not found!');
		}
	}
/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateReportRequest $request, Report $report)
	{
		$this->authorize('update', $report);

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

		$report->update($request->all());

		// Write to Log
		EventLog::event('report', $report->id, 'update', 'name', $report->name);

		return redirect()->route('reports.index')->with('success', 'Report updated successfully');

	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Report $report)
	{
		$this->authorize('delete', $report);

		$report->fill(['enable' => ! $report->enable]);
		$report->update();

		// Write to Log
		EventLog::event('report', $report->id, 'status', 'enable', $report->enable);

		return redirect()->route('reports.index')->with('success', 'Report status Updated successfully');
	}

	public function export()
	{
		$this->authorize('export', Report::class);
		$data = DB::select("SELECT id, name, title, access, article_id, start_date, end_date,
		user_id, item_id, supplier_id, project_id, category_id, dept_id, warehouse_id, order_by, IF(enable, 'Yes', 'No') as Enable, created_by, created_at, updated_by, updated_at,
		FROM reports");
		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('reports', $dataArray);
	}

	public function pr($id)
	{
		//TODO auth check
		//TODO if pr exists
		//Log::debug('tenant.report.pr storage_path() = '.storage_path());
		// NOTE: Uses InvoicePolicy
		// $this->authorize('pdfInvoice', $invoice);

		//Log::debug('Function name =' . __FUNCTION__);
		//Log::debug('Method name =' . __METHOD__);

		$setup 		= Setup::with('country_name')->first();
		$report 	= Report::where('code', __FUNCTION__)->firstOrFail();

		$pr 		= Pr::with('requestor')->where('id', $id)->firstOrFail();
		$prls 		= Prl::with('item')->where('pr_id', $pr->id)->get()->all();
		
		$title 		= $report->name. ' #'. $pr->id; ;
		$subTitle	= 'Amount: '. number_format($pr->amount, 2) .' '. $pr->currency;
		$param1 	= 'Approval: '. strtoupper($pr->auth_status);
		$param2 	= '';
		$param3 	= '';
		self::increaseRunCounter(Str::lower($report->code));
		
		$data = [
			'setup' 	=> $setup,
			'report' 	=> $report,
			'title' 	=> $title,
			'subTitle' 	=> $subTitle,
			'param1' 	=> $param1,
			'param2' 	=> $param2,
			'param3' 	=> $param3,
			'pr' 		=> $pr,
			'prls' 		=> $prls,
		];

		PDF::setOptions(['debugCss' => true]);
		$pdf = PDF::loadView('tenant.reports.formats.pr', $data);
		
		// ->setOption('fontDir', public_path('/fonts/lato'));
		self::setWatermark($pr->auth_status, $pdf);
		return $pdf->stream('PR#'.$pr->id.'.pdf');
	}

	/**
	 * Display the specified resource.
	 */
	public function prlist($start_date, $end_date, $dept_id)
	{

		$this->authorize('run',Report::class);
		$setup 		= Setup::with('country_name')->first();
		$report 	= Report::where('code', __FUNCTION__)->firstOrFail();
		$title 		= $report->name;
		$subTitle	= 'Status: APPROVED';
		$param1 	= 'From '.strtoupper(date('d-M-Y', strtotime($start_date))) .' to '.strtoupper(date('d-M-Y', strtotime($end_date)));
		if ($dept_id <> ''){
			$dept 	= Dept::where('id', $dept_id )->firstOrFail();
			$param2 	= 'Dept: '. $dept->name;
		} else {
			$param2 	= '';
		}
		$param3 	= '';

		$sql = "
			SELECT pr.id pr_id, pr.pr_date,pr.summary, pr.auth_status,d.name dept,
			u.name requestor, p.code project, s.name supplier,
			pr.currency,
			pr.sub_total, pr.tax, pr.gst, pr.amount, pr.fc_exchange_rate, pr.fc_sub_total, pr.fc_tax, pr.fc_gst, pr.fc_amount
			FROM prs pr, depts d, users u, projects p,suppliers s
			WHERE 1=1
			AND pr.auth_status = '".AuthStatusEnum::APPROVED->value."'
			AND pr.dept_id =d.id
			AND pr.requestor_id=u.id
			AND pr.project_id=p.id
			AND pr.supplier_id=s.id
			AND ". ($dept_id <> '' ? 'pr.dept_id = '.$dept_id.' ' : ' 1=1 ') ."
			AND DATE(pr.pr_date) NOT BETWEEN '".$start_date."' AND '".$end_date."'
		";

		$prs = DB::select($sql);

		$data = [
			'setup' 	=> $setup,
			'report' 	=> $report,
			'title' 	=> $title,
			'subTitle' 	=> $subTitle,
			'param1' 	=> $param1,
			'param2' 	=> $param2,
			'param3' 	=> $param3,
			'prs' 		=> $prs,
		];

		$pdf = PDF::loadView('tenant.reports.formats.prlist', $data);
		// (Optional) Setup the paper size and orientation
		$pdf->setPaper('A4', 'landscape');
		$pdf->output();

		return $pdf->stream('prs-'.strtotime("now").'.pdf');
	}

	/**
	 * Display the specified resource.
	 */
	public function prllist($start_date, $end_date, $dept_id)
	{

		$this->authorize('run',Report::class);
		
		$setup 		= Setup::with('country_name')->first();
		$report 	= Report::where('code', __FUNCTION__)->firstOrFail();
		$title 		= $report->name;
		$subTitle	= 'Status: APPROVED';
		$param1 	= 'From '.strtoupper(date('d-M-Y', strtotime($start_date))) .' to '.strtoupper(date('d-M-Y', strtotime($end_date)));
		//$param2 	= ($dept_id <> '' ? ' AND p.dept_id = '.$dept_id.' ' : ' ');
		if ($dept_id <> ''){
			$dept 	= Dept::where('id', $dept_id )->firstOrFail();
			$param2 	= 'Dept: '. $dept->name;
		} else {
			$param2 	= '';
		}
		$param3 	= '';

		$sql = "
			SELECT p.id pr_id, p.currency, d.name dept_name, p.pr_date,p.auth_status,
			l.line_num, l.item_description, u.name uom_name, l.qty, l.price, l.amount, l.fc_amount
			FROM prs p , prls l , uoms u, depts d
			WHERE 1=1
			AND p.auth_status = '".AuthStatusEnum::APPROVED->value."'
			AND p.dept_id =d.id
			AND l.uom_id=u.id
			AND p.id =l.pr_id
			AND ". ($dept_id <> '' ? 'p.dept_id = '.$dept_id.' ' : ' 1=1 ') ."
			AND DATE(p.pr_date) BETWEEN '".$start_date."' AND '".$end_date."'
		";

	//Log::debug('tenant.reports.prdetail sql = ' . $sql);
		$prls = DB::select($sql);

		$data = [
			'setup' 	=> $setup,
			'report' 	=> $report,
			'title' 	=> $title,
			'subTitle' 	=> $subTitle,
			'param1' 	=> $param1,
			'param2' 	=> $param2,
			'param3' 	=> $param3,
			'prls' 		=> $prls,
		];

		$pdf = PDF::loadView('tenant.reports.formats.prllist', $data);
		// (Optional) Setup the paper size and orientation
		$pdf->setPaper('A4', 'landscape');
		$pdf->output();

		return $pdf->stream('prl-'.strtotime("now").'.pdf');
	}

	public function po($id)
	{
		//TODO auth check
		//TODO if pr exists
		//Log::debug('tenant.report.pr storage_path() = '.storage_path());

		// NOTE: Uses InvoicePolicy
		// $this->authorize('pdfInvoice', $invoice);

		Log::debug('tenant.ReportController.po Value of po_id = ' . $id);
		$setup 		= Setup::first();
		$report 	= Report::where('code', __FUNCTION__)->firstOrFail();
		$po 		= Po::with('requestor')->where('id', $id)->firstOrFail();
		$pols 		= Pol::with('item')->where('po_id', $po->id)->get()->all();
		$title 		= $report->name. ' #'. $po->id; ;
		$subTitle	= 'Amount: '. number_format($po->amount, 2) .' '. $po->currency;
		$param1 	= 'Approval: '. strtoupper($po->auth_status);
		$param2 	= '';
		$param3 	= '';
		self::increaseRunCounter(Str::lower($report->code));

		$data = [
			'setup' 	=> $setup,
			'report' 	=> $report,
			'po' 		=> $po,
			'pols' 		=> $pols,
			'title' 	=> $title,
			'subTitle' 	=> $subTitle,
			'param1' 	=> $param1,
			'param2' 	=> $param2,
			'param3' 	=> $param3,
		];

		$pdf = PDF::loadView('tenant.reports.formats.po', $data);
		self::setWatermark($po->auth_status, $pdf);
		return $pdf->stream('PO'.$po->id.'.pdf');
	}

	public function polist($start_date, $end_date, $dept_id)
	{

		$this->authorize('run',Report::class);

		$report 	= Report::where('code', __FUNCTION__)->firstOrFail();
		$setup 		= Setup::with('country_name')->first();
		$title 		= $report->name;
		$subTitle	= 'Status: APPROVED';

		$param1 	= 'From '.strtoupper(date('d-M-Y', strtotime($start_date))) .' to '.strtoupper(date('d-M-Y', strtotime($end_date)));
		if ($dept_id <> ''){
			$dept 	= Dept::where('id', $dept_id )->firstOrFail();
			$param2 	= 'Dept: '. $dept->name;
		} else {
			$param2 	= '';
		}
		$param3 	= '';

		$sql = "
			SELECT po.id po_id, po.po_date,po.summary, po.auth_status,d.name dept,
			u.name requestor, p.name project,s.name supplier,
			po.currency,
			po.sub_total, po.tax, po.gst, po.amount, po.fc_exchange_rate, po.fc_sub_total, po.fc_tax, po.fc_gst, po.fc_amount
			FROM pos po, depts d, users u, projects p,suppliers s
			WHERE 1=1
			AND po.auth_status = '".AuthStatusEnum::APPROVED->value."'
			AND po.dept_id =d.id
			AND po.requestor_id=u.id
			AND po.project_id=p.id
			AND po.supplier_id=s.id
			AND ". ($dept_id <> '' ? 'po.dept_id = '.$dept_id.' ' : ' 1=1 ') ."
			AND DATE(po.po_date) BETWEEN '".$start_date."' AND '".$end_date."'
		";

		$pos = DB::select($sql);
		$data = [
			'setup' 	=> $setup,
			'report' 	=> $report,
			'title' 	=> $title,
			'subTitle' 	=> $subTitle,
			'param1' 	=> $param1,
			'param2' 	=> $param2,
			'param3' 	=> $param3,
			'pos' 		=> $pos,
		];

		$pdf = PDF::loadView('tenant.reports.formats.polist', $data);
		// (Optional) Setup the paper size and orientation
		$pdf->setPaper('A4', 'landscape');
		$pdf->output();

		return $pdf->stream('pos-'.strtotime("now").'.pdf');
	}

	

	public function pollist($start_date, $end_date, $dept_id)
	{

		$this->authorize('run',Report::class);

		
		$setup 		= Setup::with('country_name')->first();
		$report 	= Report::where('code', __FUNCTION__)->firstOrFail();
		$title 		= $report->name;
		$subTitle	= 'Status: APPROVED';
		$param1 	= 'From '.strtoupper(date('d-M-Y', strtotime($start_date))) .' to '.strtoupper(date('d-M-Y', strtotime($end_date)));
		$param2 	= ($dept_id <> '' ? ' AND p.dept_id = '.$dept_id.' ' : ' ');
		if ($dept_id <> ''){
			$dept 	= Dept::where('id', $dept_id )->firstOrFail();
			$param2 	= 'Dept: '. $dept->name;
		} else {
			$param2 	= '';
		}
		$param3 	= '';

		$sql = "
			SELECT p.id po_id, p.currency, d.name dept_name, p.po_date,p.auth_status,
			l.line_num, l.item_description, u.name uom_name, l.qty, l.price, l.amount, l.fc_amount
			FROM pos p , pols l , uoms u, depts d
			WHERE 1=1
			AND p.auth_status = '".AuthStatusEnum::APPROVED->value."'
			AND p.dept_id =d.id
			AND l.uom_id=u.id
			AND p.id =l.po_id
			AND ". ($dept_id <> '' ? 'p.dept_id = '.$dept_id.' ' : ' 1=1 ') ."
			AND DATE(p.po_date) BETWEEN '".$start_date."' AND '".$end_date."'
		";
	
		$pols = DB::select($sql);

		$data = [
			'setup' 	=> $setup,
			'report' 	=> $report,
			'title' 	=> $title,
			'subTitle' 	=> $subTitle,
			'param1' 	=> $param1,
			'param2' 	=> $param2,
			'param3' 	=> $param3,
			'pols' 		=> $pols,
		];

		$pdf = PDF::loadView('tenant.reports.formats.pollist', $data);
		// (Optional) Setup the paper size and orientation
		$pdf->setPaper('A4', 'landscape');
		$pdf->output();

		return $pdf->stream('pol-'.strtotime("now").'.pdf');
	}

	public function invoice($id)
	{
		//TODO auth check
		//TODO if pr exists
		// $this->authorize('pdfInvoice', $invoice);

		$setup 		= Setup::with('country_name')->first();
		$report 	= Report::where('code', __FUNCTION__)->firstOrFail();
		$invoice 	= Invoice::with('supplier')->with('po')->where('id', $id)->firstOrFail();
		$invoiceLines 		= InvoiceLine::where('invoice_id', $invoice->id)->get()->all();
		$title 		= $report->name. ' #'. $invoice->invoice_num; ;
		$subTitle	= 'Amount: '. number_format($invoice->amount, 2) .' '. $invoice->currency;
		$param1 	= 'Status: '. strtoupper($invoice->status);
		$param2 	= '';
		$param3 	= '';
		self::increaseRunCounter(Str::lower($report->code));
		
		$data = [
			'setup' 	=> $setup,
			'report' 	=> $report,
			'title' 	=> $title,
			'subTitle' 	=> $subTitle,
			'param1' 	=> $param1,
			'param2' 	=> $param2,
			'param3' 	=> $param3,
			'invoice' 		=> $invoice,
			'invoiceLines'	=> $invoiceLines,
		];

		$pdf = PDF::loadView('tenant.reports.formats.invoice', $data);
		// ->setOption('fontDir', public_path('/fonts/lato'));
		self::setWatermark($invoice->status, $pdf);
		return $pdf->stream('Invoice #'.$invoice->id.'.pdf');
	}


	public function invoicelist($start_date, $end_date, $dept_id)
	{

		$this->authorize('run',Report::class);

		
		$setup 		= Setup::with('country_name')->first();
		$report 	= Report::where('code', __FUNCTION__)->firstOrFail();
		$title 		= $report->name;
		$subTitle	= 'Status: POSTED';

		$param1 	= 'From '.strtoupper(date('d-M-Y', strtotime($start_date))) .' to '.strtoupper(date('d-M-Y', strtotime($end_date)));
		$param2 	= ($dept_id <> '' ? ' AND p.dept_id = '.$dept_id.' ' : ' ');
		if ($dept_id <> ''){
			$dept 	= Dept::where('id', $dept_id )->firstOrFail();
			$param2 	= 'Dept: '. $dept->name;
		} else {
			$param2 	= '';
		}
		$param3 	= '';

		$sql = "
			SELECT i.id, i.po_id, i.summary, i.invoice_no, i.invoice_date, i.currency,
			i.sub_total, i.tax, i.gst, i.amount, i.fc_amount,
			s.name supplier_name, d.name dept_name
			FROM invoices i, pos p, depts d, suppliers s
			WHERE 1=1
			AND i.po_id =p.id
			AND p.supplier_id = s.id
			AND i.status = '".InvoiceStatusEnum::POSTED->value."'
			AND p.dept_id =d.id
			AND ". ($dept_id <> '' ? 'p.dept_id = '.$dept_id.' ' : ' 1=1 ') ."
			AND DATE(p.po_date) BETWEEN '".$start_date."' AND '".$end_date."'
		";

		$invoices = DB::select($sql);

		$data = [
			'setup' 	=> $setup,
			'report' 	=> $report,
			'title' 	=> $title,
			'subTitle' 	=> $subTitle,
			'param1' 	=> $param1,
			'param2' 	=> $param2,
			'param3' 	=> $param3,
			'invoices'	=> $invoices,
		];

		$pdf = PDF::loadView('tenant.reports.formats.invocielist', $data);
		// (Optional) Setup the paper size and orientation
		$pdf->setPaper('A4', 'landscape');
		$pdf->output();

		return $pdf->stream('invoices-'.strtotime("now").'.pdf');
	}


	public function payment($id)
	{
		//TODO auth check
		//TODO if pr exists
		// $this->authorize('pdfInvoice', $invoice);

		$setup 		= Setup::with('country_name')->first();
		$report 	= Report::where('code', __FUNCTION__)->firstOrFail();
		$payment 	= Payment::with('invoice')->with('po')->with('bank_account')->where('id', $id)->firstOrFail();
		$title 		= $report->name. ' #'. $payment->id; ;
		$subTitle	= 'Amount: '. number_format($payment->amount, 2) .' '. $payment->currency;
		$param1 	= 'Status: '. strtoupper($payment->status);
		$param2 	= '';
		$param3 	= '';
		self::increaseRunCounter(Str::lower($report->code));
		
		$data = [
			'setup' 	=> $setup,
			'report' 	=> $report,
			'title' 	=> $title,
			'subTitle' 	=> $subTitle,
			'param1' 	=> $param1,
			'param2' 	=> $param2,
			'param3' 	=> $param3,
			'payment' 	=> $payment,
		];
		$pdf = PDF::loadView('tenant.reports.formats.payment', $data);
		// ->setOption('fontDir', public_path('/fonts/lato'));
		self::setWatermark($payment->status, $pdf);
		return $pdf->stream('Payment #'.$payment->id.'.pdf');
	}


	public function paymentlist($start_date, $end_date, $dept_id)
	{

		$this->authorize('run',Report::class);

		
		$setup 		= Setup::with('country_name')->first();
		$report 	= Report::where('code', __FUNCTION__)->firstOrFail();
		$title 		= $report->name;
		$subTitle	= 'Status: POSTED';

		$param1 	= 'From '.strtoupper(date('d-M-Y', strtotime($start_date))) .' to '.strtoupper(date('d-M-Y', strtotime($end_date)));
		$param2 	= ($dept_id <> '' ? ' AND p.dept_id = '.$dept_id.' ' : ' ');
		if ($dept_id <> ''){
			$dept 	= Dept::where('id', $dept_id )->firstOrFail();
			$param2 	= 'Dept: '. $dept->name;
		} else {
			$param2 	= '';
		}
		$param3 	= '';

		$sql = "
			SELECT pay.id, pay.invoice_id, pay.pay_date, b.ac_name, pay.cheque_no, pay.currency, pay.amount,pay.fc_amount,
			i.invoice_no, i.invoice_date,
			p.id po_id, d.name dept_name
			FROM payments pay, invoices i, pos p, depts d, bank_accounts b
			WHERE 1=1
			AND pay.invoice_id =i.id
			AND pay.bank_account_id =b.id
			AND i.po_id =p.id
			AND p.dept_id =d.id
			AND ". ($dept_id <> '' ? 'p.dept_id = '.$dept_id.' ' : ' 1=1 ') ."
			AND DATE(pay.pay_date) BETWEEN '".$start_date."' AND '".$end_date."'
		";

		$payments = DB::select($sql);

		$data = [
			'setup' 	=> $setup,
			'report' 	=> $report,
			'title' 	=> $title,
			'subTitle' 	=> $subTitle,
			'param1' 	=> $param1,
			'param2' 	=> $param2,
			'param3' 	=> $param3,
			'payments'	=> $payments,
		];

		$pdf = PDF::loadView('tenant.reports.formats.paymentlist', $data);
		// (Optional) Setup the paper size and orientation
		$pdf->setPaper('A4', 'landscape');
		$pdf->output();

		return $pdf->stream('invoices-'.strtotime("now").'.pdf');
	}


	public function receipt($id)
	{
		//TODO auth check
		//TODO if pr exists
		// $this->authorize('pdfInvoice', $invoice);

		$setup 		= Setup::with('country_name')->first();
		$report 	= Report::where('code', __FUNCTION__)->firstOrFail();
		$receipt 	= Receipt::with('pol')->with('receiver')->with('warehouse')->where('id', $id)->firstOrFail();
		$title 		= $report->name. ' #'. $receipt->id; ;
		//$subTitle	= 'Amount: '. number_format($payment->amount, 2) .' '. $payment->currency;
		$subTitle	= '';
		$param1 	= 'Status: '. strtoupper($receipt->status);
		$param2 	= '';
		$param3 	= '';
		self::increaseRunCounter(Str::lower($report->code));
		
		$data = [
			'setup' 	=> $setup,
			'report' 	=> $report,
			'title' 	=> $title,
			'subTitle' 	=> $subTitle,
			'param1' 	=> $param1,
			'param2' 	=> $param2,
			'param3' 	=> $param3,
			'receipt' 	=> $receipt,
		];
		$pdf = PDF::loadView('tenant.reports.formats.receipt', $data);
		// ->setOption('fontDir', public_path('/fonts/lato'));
		//self::setWatermark($receipt->status, $pdf);
		$pdf->setPaper('A4', 'landscape');
		$pdf->output();

		return $pdf->stream('Receipt #'.$receipt->id.'.pdf');
	}



	public function receiptlist($start_date, $end_date, $dept_id)
	{

		$this->authorize('run',Report::class);

		$setup 		= Setup::with('country_name')->first();
		$report 	= Report::where('code', __FUNCTION__)->firstOrFail();
		$title 		= $report->name;
		$subTitle	= 'Status: POSTED';

		$param1 	= 'From '.strtoupper(date('d-M-Y', strtotime($start_date))) .' to '.strtoupper(date('d-M-Y', strtotime($end_date)));
		$param2 	= ($dept_id <> '' ? ' AND p.dept_id = '.$dept_id.' ' : ' ');
		if ($dept_id <> ''){
			$dept 	= Dept::where('id', $dept_id )->firstOrFail();
			$param2 	= 'Dept: '. $dept->name;
		} else {
			$param2 	= '';
		}
		$param3 	= '';

		$sql = "
			SELECT r.id, r.receive_date, r.warehouse_id,w.name warehouse_name, r.receiver_id, r.qty rcv_qty, r.fc_amount,
			l.line_num, l.item_description, u.name uom_name,l.qty ord_qty,
			p.id po_id, p.po_date, d.name dept_name
			FROM receipts r, pols l,pos p, uoms u, depts d,warehouses w
			WHERE 1=1
			AND r.pol_id =l.id
			AND p.id =l.po_id
			AND p.dept_id =d.id
			AND l.uom_id=u.id
			AND r.warehouse_id = w.id
			AND ". ($dept_id <> '' ? 'p.dept_id = '.$dept_id.' ' : ' 1=1 ') ."
			AND DATE(r.receive_date) BETWEEN '".$start_date."' AND '".$end_date."'
		";

		$receipts = DB::select($sql);

		$data = [
			'setup' 	=> $setup,
			'report' 	=> $report,
			'title' 	=> $title,
			'subTitle' 	=> $subTitle,
			'param1' 	=> $param1,
			'param2' 	=> $param2,
			'param3' 	=> $param3,	
			'receipts'	=> $receipts,
		];

		$pdf = PDF::loadView('tenant.reports.formats.receiptlist', $data);
		// (Optional) Setup the paper size and orientation
		$pdf->setPaper('A4', 'landscape');
		$pdf->output();

		return $pdf->stream('receipts-'.strtotime("now").'.pdf');
	}
	
	public function taxregister($start_date, $end_date, $dept_id)
	{

		$this->authorize('run',Report::class);

		$setup 		= Setup::with('country_name')->first();
		$report 	= Report::where('code', __FUNCTION__)->firstOrFail();
		$title 		= $report->name;
		$subTitle	= 'Status: POSTED';

		$param1 	= 'From '.strtoupper(date('d-M-Y', strtotime($start_date))) .' to '.strtoupper(date('d-M-Y', strtotime($end_date)));
		if ($dept_id <> ''){
			$dept 	= Dept::where('id', $dept_id )->firstOrFail();
			$param2 	= 'Dept: '. $dept->name;
		} else {
			$param2 	= '';
		}
		$param3 	= '';

		$sql = "
			SELECT po.id po_id, po.po_date,po.summary, po.auth_status,d.name dept,
			u.name requestor, p.name project,s.name supplier,
			po.currency,
			po.sub_total, po.tax, po.gst, po.amount, po.fc_exchange_rate, po.fc_sub_total, po.fc_tax, po.fc_gst, po.fc_amount
			FROM pos po, depts d, users u, projects p,suppliers s
			WHERE 1=1
			AND po.auth_status = '".AuthStatusEnum::APPROVED->value."'
			AND po.dept_id =d.id
			AND po.requestor_id=u.id
			AND po.project_id=p.id
			AND po.supplier_id=s.id
			AND ". ($dept_id <> '' ? 'po.dept_id = '.$dept_id.' ' : ' 1=1 ') ."
			AND DATE(po.po_date) BETWEEN '".$start_date."' AND '".$end_date."'
		";

		$pos = DB::select($sql);

		$data = [
			'setup' 	=> $setup,
			'report' 	=> $report,
			'title' 	=> $title,
			'subTitle' 	=> $subTitle,
			'param1' 	=> $param1,
			'param2' 	=> $param2,
			'param3' 	=> $param3,
			'pos' 		=> $pos,
		];

		$pdf = PDF::loadView('tenant.reports.formats.taxregister', $data);
		// (Optional) Setup the paper size and orientation
		$pdf->setPaper('A4', 'landscape');
		$pdf->output();

		return $pdf->stream('tax-'.strtotime("now").'.pdf');
	}

	public function projectspend($start_date, $end_date, $project_id)
	{

		$this->authorize('run',Report::class);

		$setup 		= Setup::with('country_name')->first();
		$report 	= Report::where('code', __FUNCTION__)->firstOrFail();
		$title 		= $report->name;
		$subTitle	= 'Status: POSTED';

		$param1 	= 'From '.strtoupper(date('d-M-Y', strtotime($start_date))) .' to '.strtoupper(date('d-M-Y', strtotime($end_date)));
		$param2 	= "";
		$project 	= Project::where('id', $project_id )->firstOrFail();
		$param2 	= 'Project: '. $project->name;
		$param3 	= '';

		$sql = "
			SELECT po.id po_id, po.po_date,po.summary, po.auth_status,d.name dept,
			u.name requestor, p.name project,s.name supplier,
			po.currency,
			po.sub_total, po.tax, po.gst, po.amount,
			po.amount_grs, po.amount_invoice, po.amount_paid,
			po.fc_exchange_rate, po.fc_sub_total, po.fc_tax, po.fc_gst, po.fc_amount
			FROM pos po, depts d, users u, projects p,suppliers s
			WHERE 1=1
			AND po.auth_status = '".AuthStatusEnum::APPROVED->value."'
			AND po.dept_id =d.id
			AND po.requestor_id=u.id
			AND po.project_id=p.id
			AND po.supplier_id=s.id
			AND ". ($project_id <> '' ? 'po.project_id = '.$project_id.' ' : ' 1=1 ') ."
			AND DATE(po.po_date) BETWEEN '".$start_date."' AND '".$end_date."'
		";


		$pos = DB::select($sql);

		$data = [
			'setup' 	=> $setup,
			'report' 	=> $report,
			'title' 	=> $title,
			'subTitle' 	=> $subTitle,
			'param1' 	=> $param1,
			'param2' 	=> $param2,
			'param3' 	=> $param3,
			'pos'		=> $pos,
		];

		$pdf = PDF::loadView('tenant.reports.formats.projectspend', $data);
		// (Optional) Setup the paper size and orientation
		$pdf->setPaper('A4', 'landscape');
		$pdf->output();

		return $pdf->stream('project-spend-'.strtotime("now").'.pdf');
	}


	public function supplierspend($start_date, $end_date, $supplier_id)
	{

		$this->authorize('run',Report::class);

		
		$setup 		= Setup::with('country_name')->first();
		$report 	= Report::where('code', __FUNCTION__)->firstOrFail();
		$title 		= $report->name;
		$subTitle	= 'Status: POSTED';

		$param1 	= 'From '.strtoupper(date('d-M-Y', strtotime($start_date))) .' to '.strtoupper(date('d-M-Y', strtotime($end_date)));
		$param2 	= "";
		$supplier 	= Supplier::where('id', $supplier_id )->firstOrFail();
		$param2 	= 'Supplier: '. $supplier->name;
		$param3 	= '';

		$sql = "
			SELECT po.id po_id, po.po_date,po.summary, po.auth_status,d.name dept,
			u.name requestor, p.name project,s.name supplier,
			po.currency,
			po.sub_total, po.tax, po.gst, po.amount,
			po.amount_grs, po.amount_invoice, po.amount_paid,
			po.fc_exchange_rate, po.fc_sub_total, po.fc_tax, po.fc_gst, po.fc_amount
			FROM pos po, depts d, users u, projects p,suppliers s
			WHERE 1=1
			AND po.auth_status = '".AuthStatusEnum::APPROVED->value."'
			AND po.dept_id =d.id
			AND po.requestor_id=u.id
			AND po.project_id=p.id
			AND po.supplier_id=s.id
			AND ". ($supplier_id <> '' ? 'po.supplier_id = '.$supplier_id.' ' : ' 1=1 ') ."
			AND DATE(po.po_date) BETWEEN '".$start_date."' AND '".$end_date."'
		";

		// $sql = "
		// 	SELECT po.id po_id, po.po_date,po.summary, po.auth_status,d.name dept,
		// 	u.name requestor, p.name project,s.name supplier,
		// 	po.currency,
		// 	po.sub_total, po.tax, po.gst, po.amount,
		// 	po.amount_grs, po.amount_invoice, po.amount_paid,
		// 	po.fc_exchange_rate, po.fc_sub_total, po.fc_tax, po.fc_gst, po.fc_amount
		// 	FROM pos po, depts d, users u, projects p,suppliers s
		// 	WHERE 1=1
		// 	AND po.dept_id =d.id
		// 	AND po.requestor_id=u.id
		// 	AND po.project_id=p.id
		// 	AND po.supplier_id=s.id
		// 	AND ". ($supplier_id <> '' ? 'po.supplier_id = '.$supplier_id.' ' : ' 1=1 ') ."
		// ";

		$pos = DB::select($sql);

		$data = [
			'setup' 	=> $setup,
			'report' 	=> $report,
			'title' 	=> $title,
			'subTitle' 	=> $subTitle,
			'param1' 	=> $param1,
			'param2' 	=> $param2,
			'param3' 	=> $param3,
			'pos'		=> $pos,
		];

		$pdf = PDF::loadView('tenant.reports.formats.supplierspend', $data);
		// (Optional) Setup the paper size and orientation
		$pdf->setPaper('A4', 'landscape');
		$pdf->output();

		return $pdf->stream('supplier-spend-'.strtotime("now").'.pdf');
	}

	public function aellist($start_date, $end_date)
	{

		$this->authorize('run',Report::class);

		$setup 		= Setup::with('country_name')->first();
		$report 	= Report::where('code', __FUNCTION__)->firstOrFail();
		$title 		= $report->name;
		$subTitle	= 'Status: POSTED';

		$param1 	= 'From '.strtoupper(date('d-M-Y', strtotime($start_date))) .' to '.strtoupper(date('d-M-Y', strtotime($end_date)));
		$param2 	= "";
		$param3 	= "";

		$sql = "
			SELECT a.id, a.source_app,a.source_entity, a.event, a.accounting_date, al.ac_code, al.line_description,
			al.fc_currency, al.fc_dr_amount, al.fc_cr_amount,
			a.po_id, a.reference_no
			FROM aehs a, aels al 
            WHERE 1=1 
            AND a.id=al.aeh_id;
			WHERE DATE(accounting_date) BETWEEN '".$start_date."' AND '".$end_date."'
		";
		$sql = "
		SELECT a.id, a.source_app,a.source_entity, a.event, a.accounting_date, al.ac_code, al.line_description,
		al.fc_currency, al.fc_dr_amount, al.fc_cr_amount,
		a.po_id, a.reference_no
		FROM aehs a, aels al 
		WHERE 1=1 
		AND a.id=al.aeh_id;
	";

		$aels = DB::select($sql);

		$data = [
			'setup' 	=> $setup,
			'report' 	=> $report,
			'title' 	=> $title,
			'subTitle' 	=> $subTitle,
			'param1' 	=> $param1,
			'param2' 	=> $param2,
			'param3' 	=> $param3,
			'aels'		=> $aels,
		];

		$pdf = PDF::loadView('tenant.reports.formats.aellist', $data);
		// (Optional) Setup the paper size and orientation
		$pdf->setPaper('A4', 'landscape');
		$pdf->output();

		return $pdf->stream('aels-'.strtotime("now").'.pdf');
	}

	

	
	

	function increaseRunCounter($reportCode)
	{
		// Increase reports run_count
		DB::statement("UPDATE reports SET
			run_count	= run_count + 1
			WHERE code 	= '".$reportCode."'");
	}

	
	function setWatermark($text, $pdf)
	{
		// (Optional) Setup the paper size and orientation
		//$pdf->setPaper('A4', 'portrait');
		$pdf->setPaper('A4', 'landscape');
		$pdf->output();

		// Get height and width of page
		// https://www.codexworld.com/create-pdf-with-watermark-in-php-using-dompdf/
		// https://www.codesenior.com/en/tutorial/Dompdf--Create-Watermark-and-Page-Numbers#google_vignette
		$canvas = $pdf->getDomPDF()->getCanvas();
		$height = $canvas->get_height();
		$width = $canvas->get_width();

		// Specify watermark text
		//$text = Str::upper($pr->auth_status);
		$text = Str::upper($text);

		// Get height and width of text
		//$font		= $pdf->getFontMetrics()->get_font("Times", "bold");
		$font		= $pdf->getFontMetrics()->get_font("helvetica", "bold");
		$txtHeight	= $pdf->getFontMetrics()->getFontHeight($font, 75);
		$textWidth	= $pdf->getFontMetrics()->getTextWidth($text, $font, 75);

		// Specify horizontal and vertical position
		$x = (($width - $textWidth) / 1.6);
		$y = (($height - $txtHeight) / 2);

		$color = array(255,0,0);
		$canvas->set_opacity(.2,"Multiply");
		//$canvas->set_opacity(.2);

		$canvas->page_text($x, $y, $text, $font, 55, $color, 2, 2, -30);
	}
}
