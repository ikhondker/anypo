<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;


# Models
use App\Models\Setup;
use App\Models\Pr;
use App\Models\Supplier;
use App\Models\Prl;
# Enums
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

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tenant.reports.index');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReportRequest $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        //
    }

    public function pr($id)
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
        $pdf = PDF::loadView('tenant.reports.formats.pr', $data);
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
        $font       = $pdf->getFontMetrics()->get_font("lato", "bold");
        $txtHeight  = $pdf->getFontMetrics()->getFontHeight($font, 75);
        $textWidth  = $pdf->getFontMetrics()->getTextWidth($text, $font, 75);
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
        $font       = $pdf->getFontMetrics()->get_font("lato", "bold");
        $txtHeight  = $pdf->getFontMetrics()->getFontHeight($font, 75);
        $textWidth  = $pdf->getFontMetrics()->getTextWidth($text, $font, 75);
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
            'title'     => 'On-Hand Stock Report',
            'date'      => date('m/d/Y'),
            'items'  => Item::all(),
            'total'     => Item::all()->sum('price'),
            //'settings'  => Setting::first()
        ];

        $pdf = PDF::loadView('tenant.reports.formats.stocks', $data);
        return $pdf->stream('stocks.pdf');
    }

}
