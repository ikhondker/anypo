<?php

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;


use App\Models\Tenant\Report;
use App\Http\Requests\Tenant\StoreReportRequest;
use App\Http\Requests\Tenant\UpdateReportRequest;


# Models

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
# Enums
use App\Enum\UserRoleEnum;
use App\Enum\AuthStatusEnum;
use App\Enum\InvoiceStatusEnum;

# Helpers
use App\Helpers\EventLog;
use App\Helpers\Export;
# Notifications
# Mails
# Packages
# Seeded
use DB;
# Exceptions
# Events
# Package
use PDF;
use Str;
use Illuminate\Support\Facades\Log;
# TODO
# 1 . Add entity column in reports.index

class ReportController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{

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
	public function run(Report $report)
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
		//$this->authorize('view', $report);

		return view('tenant.reports.show', compact('report'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Report $report)
	{
		$pms = User::Tenant()->get();
		//$report_id='1003';
		return view('tenant.reports.parameters', compact('report','pms'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateReportRequest $request, Report $report)
	{

		//$report_id	= $request->input('report_id');
		$start_date			= $request->input('start_date');
		$end_date			= $request->input('end_date');
		$dept_id			= $request->input('dept_id');
		$supplier_id		= $request->input('supplier_id');
		$project_id			= $request->input('project_id');
		$warehouse_id		= $request->input('warehouse_id');
		$bank_account_id	= $request->input('bank_account_id');
		$pm_id				= $request->input('pm_id');

		Log::debug('tenant.report.update report_id='.$report->id);
		Log::debug('tenant.report.update start_date='.$start_date);
		Log::debug('tenant.report.update end_date='.$end_date);
		Log::debug('tenant.report.update pm_id='.$pm_id);

		switch ($report->id) {
			case '1001':
				return self::r1001();
				break;
			case '1003':
				return self::r1003();
				break;
			case '1004':
				return self::r1004($start_date, $end_date, $dept_id);
				break;	
			case '1005':
				return self::r1005($start_date, $end_date, $dept_id);
				break;	
			case '1006':
				return self::r1006($start_date, $end_date, $dept_id);
				break;
			case '1007':
				return self::r1007($start_date, $end_date, $dept_id);
				break;
			case '1008':
				return self::r1008($start_date, $end_date, $dept_id);
				break;
			default:
				Log::warning("tenant.report.update report ID not found!");
		}
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
		$this->authorize('export', Budget::class);
		$data = DB::select("SELECT id, name, title, access, article_id, start_date, end_date, user_id, item_id, supplier_id, project_id, category_id, dept_id, warehouse_id, order_by, IF(enable, 'Yes', 'No') as Enable, created_by, created_at, updated_by, updated_at, 
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
		Log::debug("Inside r1001!");
	}

	/**
	 * Display the specified resource.
	 */
	public function r1004($start_date, $end_date, $dept_id)
	{
		
		$this->authorize('run',Report::class);
		
		$report 	= Report::where('id', '1004')->firstOrFail();

		$param1 	= 'From '.strtoupper(date('d-M-Y', strtotime($start_date))) .' to '.strtoupper(date('d-M-Y', strtotime($end_date)));
		$param2 	= ($dept_id <> '' ? ' AND p.dept_id='.$dept_id.' ' : ' ');
		if ($dept_id <> ''){
			$dept 	= Dept::where('id', $dept_id )->firstOrFail();
			$param2 	= 'Dept: '. $dept->name;
		} else {
			$param2 	= '';
		}

		//TODO AND p.auth_status='".AuthStatusEnum::APPROVED->value."'
		$sql = "
			SELECT p.id pr_id, p.currency, d.name dept_name, p.pr_date,p.auth_status, 
			l.line_num, l.summary, u.name uom_name, l.qty, l.price, l.amount, l.fc_amount
			FROM prs p , prls l , uoms u, depts d
			WHERE 1=1
			AND p.auth_status = '".AuthStatusEnum::APPROVED->value."'
			AND p.dept_id =d.id 
			AND l.uom_id=u.id
			AND p.id =l.pr_id
			AND ". ($dept_id <> '' ? 'p.dept_id='.$dept_id.' ' : ' 1=1 ')  ."
			AND DATE(p.pr_date) BETWEEN '".$start_date."' AND '".$end_date."'
		";

		Log::debug('tenant.reports.r1004 sql=' . $sql);
		$prls = DB::select($sql);

		$data = [
			'report' 	=> $report,
			'param1' 	=> $param1,
			'param2' 	=> $param2,
			'prls' 		=> $prls,
		];

		$pdf = PDF::loadView('tenant.reports.formats.1004', $data);
		// (Optional) Setup the paper size and orientation
		$pdf->setPaper('A4', 'landscape');
		$pdf->output();

		return $pdf->stream('prl-'.strtotime("now").'.pdf');
	}

	public function r1005($start_date, $end_date, $dept_id)
	{
		
		$this->authorize('run',Report::class);
		
		$report 	= Report::where('id', '1005')->firstOrFail();


		$param1 	= 'From '.strtoupper(date('d-M-Y', strtotime($start_date))) .' to '.strtoupper(date('d-M-Y', strtotime($end_date)));
		$param2 	= ($dept_id <> '' ? ' AND p.dept_id='.$dept_id.' ' : ' ');
		if ($dept_id <> ''){
			$dept 	= Dept::where('id', $dept_id )->firstOrFail();
			$param2 	= 'Dept: '. $dept->name;
		} else {
			$param2 	= '';
		}

		//TODO AND p.auth_status='".AuthStatusEnum::APPROVED->value."'
		$sql = "
			SELECT p.id po_id, p.currency, d.name dept_name, p.po_date,p.auth_status, 
			l.line_num, l.summary, u.name uom_name, l.qty, l.price, l.amount, l.fc_amount
			FROM pos p , pols l , uoms u, depts d
			WHERE 1=1
			AND p.auth_status = '".AuthStatusEnum::APPROVED->value."'
			AND p.dept_id =d.id 
			AND l.uom_id=u.id
			AND p.id =l.po_id
			AND ". ($dept_id <> '' ? 'p.dept_id='.$dept_id.' ' : ' 1=1 ')  ."
			AND DATE(p.po_date) BETWEEN '".$start_date."' AND '".$end_date."'
		";
		$pols = DB::select($sql);

		$data = [
			'report' 	=> $report,
			'param1' 	=> $param1,
			'param2' 	=> $param2,
			'pols' 		=> $pols,
		];

		$pdf = PDF::loadView('tenant.reports.formats.1005', $data);
		// (Optional) Setup the paper size and orientation
		$pdf->setPaper('A4', 'landscape');
		$pdf->output();

		return $pdf->stream('pol-'.strtotime("now").'.pdf');
	}

	public function r1006($start_date, $end_date, $dept_id)
	{
		
		$this->authorize('run',Report::class);
		
		$report 	= Report::where('id', '1006')->firstOrFail();

		$param1 	= 'From '.strtoupper(date('d-M-Y', strtotime($start_date))) .' to '.strtoupper(date('d-M-Y', strtotime($end_date)));
		$param2 	= ($dept_id <> '' ? ' AND p.dept_id='.$dept_id.' ' : ' ');
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
			AND ". ($dept_id <> '' ? 'p.dept_id='.$dept_id.' ' : ' 1=1 ')  ."
			AND DATE(r.receive_date) BETWEEN '".$start_date."' AND '".$end_date."'
		";
		$receipts = DB::select($sql);

		$data = [
			'report' 	=> $report,
			'param1' 	=> $param1,
			'param2' 	=> $param2,
			'receipts'	=> $receipts,
		];

		$pdf = PDF::loadView('tenant.reports.formats.1006', $data);
		// (Optional) Setup the paper size and orientation
		$pdf->setPaper('A4', 'landscape');
		$pdf->output();

		return $pdf->stream('receipts-'.strtotime("now").'.pdf');
	}

	public function r1007($start_date, $end_date, $dept_id)
	{
		
		$this->authorize('run',Report::class);
		
		$report 	= Report::where('id', '1007')->firstOrFail();

		$param1 	= 'From '.strtoupper(date('d-M-Y', strtotime($start_date))) .' to '.strtoupper(date('d-M-Y', strtotime($end_date)));
		$param2 	= ($dept_id <> '' ? ' AND p.dept_id='.$dept_id.' ' : ' ');
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
			AND ". ($dept_id <> '' ? 'p.dept_id='.$dept_id.' ' : ' 1=1 ')  ."
			AND DATE(p.po_date) BETWEEN '".$start_date."' AND '".$end_date."'
		";
		$invoices = DB::select($sql);

		$data = [
			'report' 	=> $report,
			'param1' 	=> $param1,
			'param2' 	=> $param2,
			'invoices'	=> $invoices,
		];

		$pdf = PDF::loadView('tenant.reports.formats.1007', $data);
		// (Optional) Setup the paper size and orientation
		$pdf->setPaper('A4', 'landscape');
		$pdf->output();

		return $pdf->stream('invoices-'.strtotime("now").'.pdf');
	}

	public function r1008($start_date, $end_date, $dept_id)
	{
		
		$this->authorize('run',Report::class);
		
		$report 	= Report::where('id', '1008')->firstOrFail();


		$param1 	= 'From '.strtoupper(date('d-M-Y', strtotime($start_date))) .' to '.strtoupper(date('d-M-Y', strtotime($end_date)));
		$param2 	= ($dept_id <> '' ? ' AND p.dept_id='.$dept_id.' ' : ' ');
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

			AND ". ($dept_id <> '' ? 'p.dept_id='.$dept_id.' ' : ' 1=1 ')  ."
			AND DATE(pay.pay_date) BETWEEN '".$start_date."' AND '".$end_date."'
		";

		$payments = DB::select($sql);

		$data = [
			'report' 	=> $report,
			'param1' 	=> $param1,
			'param2' 	=> $param2,
			'payments'	=> $payments,
		];

		$pdf = PDF::loadView('tenant.reports.formats.1008', $data);
		// (Optional) Setup the paper size and orientation
		$pdf->setPaper('A4', 'landscape');
		$pdf->output();

		return $pdf->stream('invoices-'.strtotime("now").'.pdf');
	}

	public function pr($id)
	{
		//TODO auth check
		//TODO if pr exists
		//Log::debug('tenant.report.pr storage_path()='.storage_path());
		
		// NOTE: Uses InvoicePolicy
		// $this->authorize('pdfInvoice', $invoice);

		$setup 		= Setup::first();
		$report 	= Report::where('id', '1002')->firstOrFail();
		$pr 		= Pr::with('requestor')->where('id', $id)->firstOrFail();
		$prls 		= Prl::with('item')->where('pr_id', $pr->id)->get()->all();
		
		//return view('tenant.reports.formats.pr', compact('setup','pr','prls','supplier'));

		$data = [
			'setup' 	=> $setup,
			'report' 	=> $report,
			'pr' 		=> $pr,
			'prls' 		=> $prls,
		];
		
		$pdf = PDF::loadView('tenant.reports.formats.pr', $data);
			// ->setOption('fontDir', public_path('/fonts/lato'));

		// (Optional) Setup the paper size and orientation
		$pdf->setPaper('A4', 'portrait');
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
	}


	public function po($id)
	{
		//TODO auth check
		//TODO if pr exists
		//Log::debug('tenant.report.pr storage_path()='.storage_path());
		
		// NOTE: Uses InvoicePolicy
		// $this->authorize('pdfInvoice', $invoice);

		$setup 		= Setup::first();
		$report 	= Report::where('id', '1003')->firstOrFail();
		$po 		= Po::with('requestor')->where('id', $id)->firstOrFail();
		$pols 		= Pol::with('item')->where('po_id', $po->id)->get()->all();
		
		//return view('tenant.reports.formats.pr', compact('setup','pr','prls','supplier'));

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

	public function prv1($id)
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
		//$canvas->page_text($width/5, $height/2, 'ANYPO.NET', $font, 55,  array(255,153,153), 2, 2, -30);

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
		//$canvas->page_text($width/5, $height/2, 'ANYPO.NET', $font, 55,  array(255,153,153), 2, 2, -30);

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


	// onhand stock report
	public function stocks()
	{
		$data = [
			'title'		=> 'On-Hand Stock Report',
			'date'		=> date('m/d/Y'),
			'items'		=> Item::all(),
			'total'		=> Item::all()->sum('price'),
			//'settings'  => Setting::first()
		];

		$pdf = PDF::loadView('tenant.reports.formats.stocks', $data);
		return $pdf->stream('stocks.pdf');
	}

}
