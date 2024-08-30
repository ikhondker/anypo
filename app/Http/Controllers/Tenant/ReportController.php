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


use App\Models\Tenant\Lookup\Dept;
use App\Models\Tenant\Lookup\Project;
use App\Models\Tenant\Lookup\Warehouse;
use App\Models\Tenant\Lookup\Supplier;
use App\Models\Tenant\Lookup\BankAccount;

use App\Models\Tenant\Admin\Setup;
# 2. Enums
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
			$reports = $reports->orderBy('id', 'ASC')->paginate(100);
			return view('tenant.reports.all', compact('reports'));
		} else {
			$reports = $reports->where('enable', true)->orderBy('id', 'ASC')->paginate(100);
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
		$start_date			= $request->input('start_date');
		$end_date			= $request->input('end_date');
		$dept_id			= $request->input('dept_id');
		$supplier_id		= $request->input('supplier_id');
		$project_id			= $request->input('project_id');
		$warehouse_id		= $request->input('warehouse_id');
		$bank_account_id	= $request->input('bank_account_id');
		$pm_id				= $request->input('pm_id');

		Log::debug('tenant.report.run report_id = '.$report->id);
		Log::debug('tenant.report.run start_date = '.$start_date);
		Log::debug('tenant.report.run end_date = '.$end_date);
		Log::debug('tenant.report.run pm_id = '.$pm_id);

		// Increse reports run_count -------------------------
		DB::statement("UPDATE reports SET
				run_count	= run_count + 1
				WHERE id 	= ".$report->id."");

		switch ($report->id) {
			case '1001':
				return self::r1001();
				break;
			case '1020':
				return self::r1020($start_date, $end_date, $dept_id);
				break;
			case '1025':
				return self::r1025($start_date, $end_date, $dept_id);
				break;
			case '1030':
				return self::r1030($start_date, $end_date, $dept_id);
				break;
			case '1035':
				return self::r1035($start_date, $end_date, $dept_id);
				break;
			case '1040':
				return self::r1040($start_date, $end_date, $dept_id);
				break;
			case '1045':
				return self::r1045($start_date, $end_date, $dept_id);
				break;
			case '1050':
				return self::r1050($start_date, $end_date, $dept_id);
				break;
			case '1055':
				return self::r1055($start_date, $end_date, $dept_id);
				break;
			case '1060':
				return self::r1060($start_date, $end_date, $project_id);
				break;
			case '1065':
				return self::r1065($start_date, $end_date, $supplier_id);
				break;
			case '1070':
				return self::r1070($start_date, $end_date);
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

	/**
	 * Display the specified resource.
	 */
	public function r1001()
	{
		Log::debug("tenant.report.r1001 inside !");
	}

	/**
	 * Display the specified resource.
	 */
	public function r1020($start_date, $end_date, $dept_id)
	{

		$this->authorize('run',Report::class);

		$report 	= Report::where('id', '1020')->firstOrFail();
		$param1 	= 'From '.strtoupper(date('d-M-Y', strtotime($start_date))) .' to '.strtoupper(date('d-M-Y', strtotime($end_date)));
		if ($dept_id <> ''){
			$dept 	= Dept::where('id', $dept_id )->firstOrFail();
			$param2 	= 'Dept: '. $dept->name;
		} else {
			$param2 	= '';
		}

		$sql = "
			SELECT pr.id pr_id, pr.pr_date,pr.summary, pr.auth_status,d.name dept,
			u.name requestor, p.name project,s.name supplier,
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
			AND DATE(pr.pr_date) BETWEEN '".$start_date."' AND '".$end_date."'
		";

		//Log::debug('tenant.reports.r1020 sql = ' . $sql);
		$prs = DB::select($sql);

		$data = [
			'report' 	=> $report,
			'param1' 	=> $param1,
			'param2' 	=> $param2,
			'prs' 		=> $prs,
		];

		$pdf = PDF::loadView('tenant.reports.formats.1020', $data);
		// (Optional) Setup the paper size and orientation
		$pdf->setPaper('A4', 'landscape');
		$pdf->output();

		return $pdf->stream('prs-'.strtotime("now").'.pdf');
	}

	public function r1025($start_date, $end_date, $dept_id)
	{

		$this->authorize('run',Report::class);

		$report 	= Report::where('id', '1025')->firstOrFail();

		$param1 	= 'From '.strtoupper(date('d-M-Y', strtotime($start_date))) .' to '.strtoupper(date('d-M-Y', strtotime($end_date)));
		if ($dept_id <> ''){
			$dept 	= Dept::where('id', $dept_id )->firstOrFail();
			$param2 	= 'Dept: '. $dept->name;
		} else {
			$param2 	= '';
		}

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
			'report' 	=> $report,
			'param1' 	=> $param1,
			'param2' 	=> $param2,
			'pos' 		=> $pos,
		];

		$pdf = PDF::loadView('tenant.reports.formats.1025', $data);
		// (Optional) Setup the paper size and orientation
		$pdf->setPaper('A4', 'landscape');
		$pdf->output();

		return $pdf->stream('pos-'.strtotime("now").'.pdf');
	}

	/**
	 * Display the specified resource.
	 */
	public function r1030($start_date, $end_date, $dept_id)
	{

		$this->authorize('run',Report::class);

		$report 	= Report::where('id', '1030')->firstOrFail();

		$param1 	= 'From '.strtoupper(date('d-M-Y', strtotime($start_date))) .' to '.strtoupper(date('d-M-Y', strtotime($end_date)));
		//$param2 	= ($dept_id <> '' ? ' AND p.dept_id = '.$dept_id.' ' : ' ');
		if ($dept_id <> ''){
			$dept 	= Dept::where('id', $dept_id )->firstOrFail();
			$param2 	= 'Dept: '. $dept->name;
		} else {
			$param2 	= '';
		}

		$sql = "
			SELECT p.id pr_id, p.currency, d.name dept_name, p.pr_date,p.auth_status,
			l.line_num, l.summary, u.name uom_name, l.qty, l.price, l.amount, l.fc_amount
			FROM prs p , prls l , uoms u, depts d
			WHERE 1=1
			AND p.auth_status = '".AuthStatusEnum::APPROVED->value."'
			AND p.dept_id =d.id
			AND l.uom_id=u.id
			AND p.id =l.pr_id
			AND ". ($dept_id <> '' ? 'p.dept_id = '.$dept_id.' ' : ' 1=1 ') ."
			AND DATE(p.pr_date) BETWEEN '".$start_date."' AND '".$end_date."'
		";

		//Log::debug('tenant.reports.r1030 sql = ' . $sql);
		$prls = DB::select($sql);

		$data = [
			'report' 	=> $report,
			'param1' 	=> $param1,
			'param2' 	=> $param2,
			'prls' 		=> $prls,
		];

		$pdf = PDF::loadView('tenant.reports.formats.1030', $data);
		// (Optional) Setup the paper size and orientation
		$pdf->setPaper('A4', 'landscape');
		$pdf->output();

		return $pdf->stream('prl-'.strtotime("now").'.pdf');
	}

	public function r1035($start_date, $end_date, $dept_id)
	{

		$this->authorize('run',Report::class);

		$report 	= Report::where('id', '1035')->firstOrFail();


		$param1 	= 'From '.strtoupper(date('d-M-Y', strtotime($start_date))) .' to '.strtoupper(date('d-M-Y', strtotime($end_date)));
		$param2 	= ($dept_id <> '' ? ' AND p.dept_id = '.$dept_id.' ' : ' ');
		if ($dept_id <> ''){
			$dept 	= Dept::where('id', $dept_id )->firstOrFail();
			$param2 	= 'Dept: '. $dept->name;
		} else {
			$param2 	= '';
		}

		$sql = "
			SELECT p.id po_id, p.currency, d.name dept_name, p.po_date,p.auth_status,
			l.line_num, l.summary, u.name uom_name, l.qty, l.price, l.amount, l.fc_amount
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
			'report' 	=> $report,
			'param1' 	=> $param1,
			'param2' 	=> $param2,
			'pols' 		=> $pols,
		];

		$pdf = PDF::loadView('tenant.reports.formats.1035', $data);
		// (Optional) Setup the paper size and orientation
		$pdf->setPaper('A4', 'landscape');
		$pdf->output();

		return $pdf->stream('pol-'.strtotime("now").'.pdf');
	}

	public function r1040($start_date, $end_date, $dept_id)
	{

		$this->authorize('run',Report::class);

		$report 	= Report::where('id', '1040')->firstOrFail();

		$param1 	= 'From '.strtoupper(date('d-M-Y', strtotime($start_date))) .' to '.strtoupper(date('d-M-Y', strtotime($end_date)));
		$param2 	= ($dept_id <> '' ? ' AND p.dept_id = '.$dept_id.' ' : ' ');
		if ($dept_id <> ''){
			$dept 	= Dept::where('id', $dept_id )->firstOrFail();
			$param2 	= 'Dept: '. $dept->name;
		} else {
			$param2 	= '';
		}

		$sql = "
			SELECT r.id, r.receive_date, r.warehouse_id,w.name warehouse_name, r.receiver_id, r.qty rcv_qty, r.fc_amount,
			l.line_num, l.summary, u.name uom_name,l.qty ord_qty,
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
			'report' 	=> $report,
			'param1' 	=> $param1,
			'param2' 	=> $param2,
			'receipts'	=> $receipts,
		];

		$pdf = PDF::loadView('tenant.reports.formats.1040', $data);
		// (Optional) Setup the paper size and orientation
		$pdf->setPaper('A4', 'landscape');
		$pdf->output();

		return $pdf->stream('receipts-'.strtotime("now").'.pdf');
	}

	public function r1045($start_date, $end_date, $dept_id)
	{

		$this->authorize('run',Report::class);

		$report 	= Report::where('id', '1045')->firstOrFail();

		$param1 	= 'From '.strtoupper(date('d-M-Y', strtotime($start_date))) .' to '.strtoupper(date('d-M-Y', strtotime($end_date)));
		$param2 	= ($dept_id <> '' ? ' AND p.dept_id = '.$dept_id.' ' : ' ');
		if ($dept_id <> ''){
			$dept 	= Dept::where('id', $dept_id )->firstOrFail();
			$param2 	= 'Dept: '. $dept->name;
		} else {
			$param2 	= '';
		}

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
			'report' 	=> $report,
			'param1' 	=> $param1,
			'param2' 	=> $param2,
			'invoices'	=> $invoices,
		];

		$pdf = PDF::loadView('tenant.reports.formats.1045', $data);
		// (Optional) Setup the paper size and orientation
		$pdf->setPaper('A4', 'landscape');
		$pdf->output();

		return $pdf->stream('invoices-'.strtotime("now").'.pdf');
	}

	public function r1050($start_date, $end_date, $dept_id)
	{

		$this->authorize('run',Report::class);

		$report 	= Report::where('id', '1050')->firstOrFail();


		$param1 	= 'From '.strtoupper(date('d-M-Y', strtotime($start_date))) .' to '.strtoupper(date('d-M-Y', strtotime($end_date)));
		$param2 	= ($dept_id <> '' ? ' AND p.dept_id = '.$dept_id.' ' : ' ');
		if ($dept_id <> ''){
			$dept 	= Dept::where('id', $dept_id )->firstOrFail();
			$param2 	= 'Dept: '. $dept->name;
		} else {
			$param2 	= '';
		}

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
			'report' 	=> $report,
			'param1' 	=> $param1,
			'param2' 	=> $param2,
			'payments'	=> $payments,
		];

		$pdf = PDF::loadView('tenant.reports.formats.1050', $data);
		// (Optional) Setup the paper size and orientation
		$pdf->setPaper('A4', 'landscape');
		$pdf->output();

		return $pdf->stream('invoices-'.strtotime("now").'.pdf');
	}


	public function r1055($start_date, $end_date, $dept_id)
	{

		$this->authorize('run',Report::class);

		$report 	= Report::where('id', '1055')->firstOrFail();

		$param1 	= 'From '.strtoupper(date('d-M-Y', strtotime($start_date))) .' to '.strtoupper(date('d-M-Y', strtotime($end_date)));
		if ($dept_id <> ''){
			$dept 	= Dept::where('id', $dept_id )->firstOrFail();
			$param2 	= 'Dept: '. $dept->name;
		} else {
			$param2 	= '';
		}

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
			'report' 	=> $report,
			'param1' 	=> $param1,
			'param2' 	=> $param2,
			'pos' 		=> $pos,
		];

		$pdf = PDF::loadView('tenant.reports.formats.1055', $data);
		// (Optional) Setup the paper size and orientation
		$pdf->setPaper('A4', 'landscape');
		$pdf->output();

		return $pdf->stream('tax-'.strtotime("now").'.pdf');
	}

	public function r1060($start_date, $end_date, $project_id)
	{

		$this->authorize('run',Report::class);

		$report 	= Report::where('id', '1060')->firstOrFail();

		$param1 	= 'From '.strtoupper(date('d-M-Y', strtotime($start_date))) .' to '.strtoupper(date('d-M-Y', strtotime($end_date)));
		$param2 	= "";
		$project 	= Project::where('id', $project_id )->firstOrFail();
		$param2 	= 'Project: '. $project->name;

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
			'report' 	=> $report,
			'param1' 	=> $param1,
			'param2' 	=> $param2,
			'pos'		=> $pos,
		];

		$pdf = PDF::loadView('tenant.reports.formats.1060', $data);
		// (Optional) Setup the paper size and orientation
		$pdf->setPaper('A4', 'landscape');
		$pdf->output();

		return $pdf->stream('project-spend--'.strtotime("now").'.pdf');
	}


	public function r1065($start_date, $end_date, $supplier_id)
	{

		$this->authorize('run',Report::class);

		$report 	= Report::where('id', '1065')->firstOrFail();

		$param1 	= 'From '.strtoupper(date('d-M-Y', strtotime($start_date))) .' to '.strtoupper(date('d-M-Y', strtotime($end_date)));
		$param2 	= "";
		$supplier 	= Supplier::where('id', $supplier_id )->firstOrFail();
		$param2 	= 'Supplier: '. $supplier->name;

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
		$pos = DB::select($sql);

		$data = [
			'report' 	=> $report,
			'param1' 	=> $param1,
			'param2' 	=> $param2,
			'pos'		=> $pos,
		];

		$pdf = PDF::loadView('tenant.reports.formats.1065', $data);
		// (Optional) Setup the paper size and orientation
		$pdf->setPaper('A4', 'landscape');
		$pdf->output();

		return $pdf->stream('supplier-spend-'.strtotime("now").'.pdf');
	}

	public function r1070($start_date, $end_date)
	{

		$this->authorize('run',Report::class);

		$report 	= Report::where('id', '1070')->firstOrFail();

		$param1 	= 'From '.strtoupper(date('d-M-Y', strtotime($start_date))) .' to '.strtoupper(date('d-M-Y', strtotime($end_date)));
		$param2 	= "";
		//$supplier 	= Supplier::where('id', $supplier_id )->firstOrFail();
		$param2 	= "";

		$sql = "
			SELECT id, source, entity, event, accounting_date, ac_code, line_description,
			fc_currency, fc_dr_amount, fc_cr_amount,
			po_id, reference
			FROM aels
			WHERE DATE(accounting_date) BETWEEN '".$start_date."' AND '".$end_date."'
		";
		$aels = DB::select($sql);

		$data = [
			'report' 	=> $report,
			'param1' 	=> $param1,
			'param2' 	=> $param2,
			'aels'		=> $aels,
		];

		$pdf = PDF::loadView('tenant.reports.formats.1070', $data);
		// (Optional) Setup the paper size and orientation
		$pdf->setPaper('A4', 'landscape');
		$pdf->output();

		return $pdf->stream('aels-'.strtotime("now").'.pdf');
	}

	public function pr($id)
	{
		//TODO auth check
		//TODO if pr exists
		//Log::debug('tenant.report.pr storage_path() = '.storage_path());

		// NOTE: Uses InvoicePolicy
		// $this->authorize('pdfInvoice', $invoice);

		$setup 		= Setup::with('country_name')->first();
		$report 	= Report::where('id', '1010')->firstOrFail();
		$pr 		= Pr::with('requestor')->where('id', $id)->firstOrFail();
		$prls 		= Prl::with('item')->where('pr_id', $pr->id)->get()->all();

		$title 		= 'Purchase Requisiton #'. $pr->id;
		$subTitle 	= 'Approval : '. strtoupper($pr->auth_status);
		$param1		= 'Amount : '. number_format($pr->amount, 2) .' '. $pr->currency;
		$param2 	= 'Requestor : '. $pr->requestor->name;
		$param3 	= 'Date : ' .strtoupper(date('d-M-Y', strtotime($pr->pr_date)));

		// Increase reports run_count
		DB::statement("UPDATE reports SET
		run_count	= run_count + 1
		WHERE id 	= ".$report->id."");

		//return view('tenant.reports.formats.pr', compact('setup','pr','prls','supplier'));

		$data = [
			'setup' 	=> $setup,
			'report' 	=> $report,
			'pr' 		=> $pr,
			'prls' 		=> $prls,
			'title' 	=> $title,
			'subTitle' 	=> $subTitle,
			'param1' 	=> $param1,
			'param2' 	=> $param2,
			'param3' 	=> $param3,

		];

		$pdf = PDF::loadView('tenant.reports.formats.pr', $data);
			// ->setOption('fontDir', public_path('/fonts/lato'));

		// (Optional) Setup the paper size and orientation
		//$pdf->setPaper('A4', 'portrait');
		$pdf->setPaper('A4', 'landscape');
		$pdf->output();

		// Get height and width of page
		$canvas = $pdf->getDomPDF()->getCanvas();
		$height = $canvas->get_height();
		$width = $canvas->get_width();

		// Specify watermark text
		$text = Str::upper($pr->auth_status);

		// Get height and width of text
		//$font		= $pdf->getFontMetrics()->get_font("Times", "bold");
		$font		= $pdf->getFontMetrics()->get_font("helvetica", "bold");
		$txtHeight	= $pdf->getFontMetrics()->getFontHeight($font, 75);
		$textWidth	= $pdf->getFontMetrics()->getTextWidth($text, $font, 75);

		// Specify horizontal and vertical position
		$x = (($width - $textWidth) / 1.6);
		$y = (($height - $txtHeight) / 2);

		$color = array(255,0,0);
		//$canvas->set_opacity(.2,"Multiply");
		$canvas->set_opacity(.2);

		$canvas->page_text($x, $y, $text, $font, 55, $color, 2, 2, -30);

		return $pdf->stream('Pr'.$pr->id.'.pdf');

		//return view('tenant.reports.formats.pr', compact('setup','report','pr','prls','param1','param2'));



	}


	public function po($id)
	{
		//TODO auth check
		//TODO if pr exists
		//Log::debug('tenant.report.pr storage_path() = '.storage_path());

		// NOTE: Uses InvoicePolicy
		// $this->authorize('pdfInvoice', $invoice);


		Log::debug('tenant.ReportController.po Value of id = ' . $id);

		$setup 		= Setup::first();
		$report 	= Report::where('id', '1015')->firstOrFail();
		$po 		= Po::with('requestor')->where('id', $id)->firstOrFail();
		$pols 		= Pol::with('item')->where('po_id', $po->id)->get()->all();

		//return view('tenant.reports.formats.pr', compact('setup','pr','prls','supplier'));
		// Increase reports run_count
		DB::statement("UPDATE reports SET
		run_count	= run_count + 1
		WHERE id 	= ".$report->id."");

		$data = [
			'setup' 	=> $setup,
			'report' 	=> $report,
			'po' 		=> $po,
			'pols' 		=> $pols,
		];


		$pdf = PDF::loadView('tenant.reports.formats.po', $data);
			// ->setOption('fontDir', public_path('/fonts/lato'));

		// (Optional) Setup the paper size and orientation
		$pdf->setPaper('A4', 'portrait');
		$pdf->output();


		// Get height and width of page
		$canvas = $pdf->getDomPDF()->getCanvas();
		$height = $canvas->get_height();
		$width = $canvas->get_width();

		// Specify watermark text
		$text = Str::upper($po->auth_status);

		// Get height and width of text
		//$font		= $pdf->getFontMetrics()->get_font("Times", "bold");
		$font		= $pdf->getFontMetrics()->get_font("helvetica", "bold");
		$txtHeight	= $pdf->getFontMetrics()->getFontHeight($font, 75);
		$textWidth	= $pdf->getFontMetrics()->getTextWidth($text, $font, 75);

		// Specify horizontal and vertical position
		$x = (($width - $textWidth) / 1.6);
		$y = (($height - $txtHeight) / 2);

		$color = array(255,0,0);
		//$canvas->set_opacity(.2,"Multiply");
		$canvas->set_opacity(.2);

		$canvas->page_text($x, $y, $text, $font, 55, $color, 2, 2, -30);

		return $pdf->stream('PO'.$po->id.'.pdf');
	}

	public function chk_prv1($id)
	{
		//todo auth check
		//todo if pr exists
		$setup = Setup::first();
		//$setup = Setup::where('id', config('akk.SETUP_ID'))->firstOrFail();
		$pr = Pr::with('requestor')->where('id', $id)->firstOrFail();
		$supplier = Supplier::where('id', $pr->supplier_id)->firstOrFail();
		$prls = Prl::with('item')->where('pr_id', $pr->id)->get()->all();

		//$prls = Prl::where('pr_id', $id)->firstOrFail();
		//$prls = Prl::getLinesByPrId($id);
		//$prls = Prl::By_pr_id($id);
		//$prls = Prl::where('pr_id', $id)->firstOrFail();
		//dd($id, $prls);

		$data = [
			'title' => 'Company XYZ',
			'id' => $id,
			'date' => date('m/d/Y'),
			'setup' => $setup,
			'pr' => $pr,
			'supplier' => $supplier,
			'prls' => $prls,
		];
		$pdf = PDF::loadView('tenant.reports.formats.prv1', $data);
		// (Optional) Setup the paper size and orientation
		$pdf->setPaper('A4', 'portrait');
		$pdf->output();
		// Get height and width of page

		$canvas = $pdf->getDomPDF()->getCanvas();
		$height = $canvas->get_height();
		$width = $canvas->get_width();

		// Specify watermark text
		$text = "DRAFT";

		// Get height and width of text
		$font		= $pdf->getFontMetrics()->get_font("lato", "bold");
		$txtHeight	= $pdf->getFontMetrics()->getFontHeight($font, 75);
		$textWidth 	= $pdf->getFontMetrics()->getTextWidth($text, $font, 75);
		// Specify horizontal and vertical position
		$x = (($width - $textWidth) / 1.4);
		$y = (($height - $txtHeight) / 2);

		$color = array(255,0,0);
		//$canvas->set_opacity(.2,"Multiply");
		$canvas->set_opacity(.2);

		$canvas->page_text($x, $y, $text, $font, 55, $color, 2, 2, -30);
		//$canvas->page_text($width/5, $height/2, $text, $font, 55, array(125,0,0),2,2,-30);
		//$canvas->page_text($width/5, $height/2, 'ANYPO.NET', $font, 55,array(255,153,153), 2, 2, -30);

		return $pdf->stream('templatepr.pdf');
	}

	// Generate PDF
	public function createPDF()
	{
		//Route::get('/report/createPDF',[ReportController::class, 'createPDF'])->name('reports.createPDF');
		$data = [
			'title' => 'Company XYZ',
			'date' => date('m/d/Y'),
			//'products' => Product::all()
		];
		$pdf = PDF::loadView('tenant.reports.rnd.htmltable', $data);
		//$pdf = PDF::loadView('reports.htmltable', $data)->setPaper('A4', 'landscape');
		//$pdf = PDF::loadView('reports.style2', $data);
		//$pdf = PDF::loadView('reports.appstack', $data);
		//$pdf = PDF::loadView('reports.style3', $data);
		return $pdf->stream('htmltable.pdf');

		//$pdf = PDF::loadView('Center.View_download', compact('view','center_detail'))->setPaper(customPaper, 'landscape');

		// R&D bellow
		//Try to set isHtml5ParserEnabled option to true:
		//PDF::setOptions(['dpi' => 150, 'isHtml5ParserEnabled' => true, 'defaultFont' => 'sans-serif']);
		//PDF::setBasePath(public_path().'/tenancy/assets/css/');

		// $pdf = app()->make('dompdf.wrapper'); // $pdf is now a PDF instance
		// $pdf->getDomPDF()->setBasePath(public_path().'/img/');
		// //NOT $pdf = PDF::loadHTML($content); // don't create a NEW instance, use the existing $pdf instance
		// $pdf->loadHTML($content);
		// return $pdf->download('certificates.pdf');
		//$dompdf->set_base_path("/www/public/css/");

		// $pdf = app()->make('dompdf.wrapper'); // $pdf is now a PDF instance
		// $pdf->getDomPDF()->setBasePath(public_path().'/tenancy/assets/css/');
		// $pdf->loadView('reports.appstack', $data);

		// poppin font not found
		//$pdf = PDF::loadView('reports.appstack', ['Data' => $data])->setOptions(['defaultFont' => 'sans-serif']);

	}


	public function templatepr()
	{
		$data = [
			'title' => 'Company XYZ',
			'date' => date('m/d/Y'),
			//'products' => Product::all()
		];
		$pdf = PDF::loadView('tenant.reports.rnd.template-pr', $data);
		// (Optional) Setup the paper size and orientation
		$pdf->setPaper('A4', 'portrait');
		$pdf->output();
		// Get height and width of page

		$canvas = $pdf->getDomPDF()->getCanvas();
		$height = $canvas->get_height();
		$width = $canvas->get_width();

		// Specify watermark text
		$text = "DRAFT";

		// Get height and width of text
		$font		= $pdf->getFontMetrics()->get_font("lato", "bold");
		$txtHeight	= $pdf->getFontMetrics()->getFontHeight($font, 75);
		$textWidth	= $pdf->getFontMetrics()->getTextWidth($text, $font, 75);
		// Specify horizontal and vertical position
		$x = (($width - $textWidth) / 1.4);
		$y = (($height - $txtHeight) / 2);

		$color = array(255,0,0);
		//$canvas->set_opacity(.2,"Multiply");
		$canvas->set_opacity(.2);

		$canvas->page_text($x, $y, $text, $font, 55, $color, 2, 2, -30);
		//$canvas->page_text($width/5, $height/2, $text, $font, 55, array(125,0,0),2,2,-30);
		//$canvas->page_text($width/5, $height/2, 'ANYPO.NET', $font, 55, array(255,153,153), 2, 2, -30);

		return $pdf->stream('templatepr.pdf');
	}

	public function templatepo()
	{
		$data = [
			'title' => 'Company XYZ PR',
			'date' => date('m/d/Y'),
			//'products' => Product::all()
		];
		$pdf = PDF::loadView('tenant.reports.rnd.template-po', $data);
		return $pdf->stream('templatepo.pdf');
	}


}
