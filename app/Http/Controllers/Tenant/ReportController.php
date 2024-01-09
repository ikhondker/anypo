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
use App\Models\Tenant\Lookup\Supplier;
use App\Models\Tenant\Admin\Setup;
# Enums
use App\Enum\UserRoleEnum;
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
			return view('tenant.reports.all', compact('reports'))->with('i', (request()->input('page', 1) - 1) * 10);
		} else {
			$reports = $reports->where('enable', true)->orderBy('id', 'ASC')->paginate(100);
			return view('tenant.reports.index', compact('reports'))->with('i', (request()->input('page', 1) - 1) * 10);
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
		$report_id='1003';
		return view('tenant.reports.parameters', compact('report','pms'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateReportRequest $request, Report $report)
	{
		Log::debug('storage_path()='.storage_path());

		//$report_id	= $request->input('report_id');
		$start_date	= $request->input('start_date');
		$end_date	= $request->input('end_date');
		$pm_id		= $request->input('pm_id');

		Log::debug('report_id='.$report->id);
		Log::debug('start_date='.$start_date);
		Log::debug('end_date='.$end_date);
		Log::debug('pm_id='.$pm_id);

		switch ($report->id) {
			case '1001':
				return self::r1001();
				break;
			case '1003':
				return self::r1003();
				break;
			case '1006':
				return self::r1006($start_date, $end_date);
				break;
			default:
				Log::debug("Report ID not found!");
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
	public function r1006($start_date, $end_date, $id='1004')
	{
		
		// NOTE: Uses InvoicePolicy
		//$this->authorize('pdfInvoice', $invoice);
		Log::debug('INISDE r1006');
		Log::debug('start_date='.$start_date);
		Log::debug('end_date='.$end_date);

		$setup 		= Setup::first();
		$report 	= Report::where('id', '1006')->firstOrFail();
		$pr 		= Pr::with('requestor')->where('id', $id)->firstOrFail();
		$supplier 	= Supplier::where('id', $pr->supplier_id)->firstOrFail();
		//$prls 	= Prl::with('item')->where('pr_id', $pr->id)->get()->all();
		//$prls 		= Prl::with('pr')->with('item')->get()->all();
		//$prls = DB::select("SELECT * FROM prls");
		$prls = DB::select("
			SELECT p.id pr_id, p.pr_date,p.auth_status, 
			l.line_num,l.summary, l.item_id, l.qty, l.price, l.amount FROM prs p , prls l 
			WHERE p.id =l.pr_id
			AND p.pr_date BETWEEN '".$start_date."' AND '".$end_date."'
		");

		//return view('tenant.reports.formats.1006', compact('setup','pr','prls','supplier','report'));

		$data = [
			'param1' 	=> 'From '.strtoupper(date('d-M-Y', strtotime($start_date))) .' to '.strtoupper(date('d-M-Y', strtotime($end_date))),
			'param2' 	=> 'empty',
			'setup' 	=> $setup,
			'report' 	=> $report,
			//'pr' 		=> $pr,
			'prls' 		=> $prls,
		];

		$pdf = PDF::loadView('tenant.reports.formats.1006', $data);
		// (Optional) Setup the paper size and orientation
		$pdf->setPaper('A4', 'landscape');
		$pdf->output();

		return $pdf->stream('Prl'.$pr->id.'.pdf');
	}

	public function pr($id)
	{
		//todo auth check
		//todo if pr exists
		//Log::debug('storage_path()='.storage_path());
		

		// NOTE: Uses InvoicePolicy
		//$this->authorize('pdfInvoice', $invoice);

		$setup = Setup::first();
		$pr = Pr::with('requestor')->where('id', $id)->firstOrFail();
		$supplier = Supplier::where('id', $pr->supplier_id)->firstOrFail();
		$prls = Prl::with('item')->where('pr_id', $pr->id)->get()->all();
		
		//return view('tenant.reports.formats.pr', compact('setup','pr','prls','supplier'));

		$data = [
			//'title' 	=> 'Company XYZ',
			'id' 		=> $pr->id,
			'date' 		=> date('m/d/Y'),
			'setup' 	=> $setup,
			'pr' 		=> $pr,
			'supplier' 	=> $supplier,
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
		$text = Str::upper($pr->auth_status->name);

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

	public function prv1($id)
	{

		Log::debug('storage_path()='.storage_path());
		//storage_path()=D:\laravel\anypo\storage/tenantdemo1  

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
