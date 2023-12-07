<?php

namespace App\Http\Controllers\Landlord;

use App\Http\Controllers\Controller;

use App\Models\Landlord\Report;
use App\Models\Landlord\Payment;
use App\Models\Landlord\Invoice;
use App\Models\Landlord\Account;

use App\Models\Landlord\Manage\Setup;

use App\Http\Requests\Landlord\StoreReportRequest;
use App\Http\Requests\Landlord\UpdateReportRequest;

# Seeded
use DB;
use Str;
use Illuminate\Support\Facades\Log;

# Package
use PDF;

class ReportController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		//
	}

	public function viewPdfInvoice(Invoice $invoice)
	{

		//Log::info(json_encode($invoice)); 
		//$this->authorize('xxInvoice', Invoice::class);
		
		// NOTE: Uses InvoicePolicy
		$this->authorize('pdfInvoice', $invoice);

		$setup = Setup::first();
		
		//dd($invoice);
		//$invoice = Invoice::with('status','owner')->where('id', $id)->firstOrFail();

		$account = Account::where('id', $invoice->account_id)->firstOrFail();
		//dd($payment);
		//$setup = Setup::where('id', config('akk.SETUP_ID'))->firstOrFail();
		//$pr = Pr::with('requestor')->where('id', $id)->firstOrFail();
		//$supplier = Supplier::where('id', $pr->supplier_id)->firstOrFail();
		//$prls = Prl::with('item')->where('pr_id', $pr->id)->get()->all();

		//$prls = Prl::where('pr_id', $id)->firstOrFail();
		//$prls = Prl::getLinesByPrId($id);
		//$prls = Prl::By_pr_id($id);
		//$prls = Prl::where('pr_id', $id)->firstOrFail();
		//dd($id, $prls);

		$data = [
			'title' => 'Company XYZ',
			'id' => $invoice->id,
			'date' => date('m/d/Y'),
			'setup' => $setup,
			'invoice' => $invoice,
			'account' => $account,
		];
		
		$pdf = PDF::loadView('landlord.reports.formats.invoice', $data);
		// (Optional) Setup the paper size and orientation
		$pdf->setPaper('A4', 'portrait');
		$pdf->output();
		// Get height and width of page

		$canvas = $pdf->getDomPDF()->getCanvas();
		$height = $canvas->get_height();
		$width = $canvas->get_width();

		// Specify watermark text
		//$text = "DRAFT";
		$text = Str::upper($invoice->status->name);

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
		

		return $pdf->stream('invoice.pdf');
	}


	public function viewPdfPayment(Payment $payment)
	{

		// NOTE: Uses InvoicePolicy
		$this->authorize('pdfPayment', $payment);

		$setup = Setup::first();
		//$payment = Payment::where('id', $id)->firstOrFail();
		$invoice = Invoice::where('id', $payment->invoice_id)->firstOrFail();
		$account = Account::where('id', $payment->account_id)->firstOrFail();
		//dd($payment);
		//$setup = Setup::where('id', config('akk.SETUP_ID'))->firstOrFail();
		//$pr = Pr::with('requestor')->where('id', $id)->firstOrFail();
		//$supplier = Supplier::where('id', $pr->supplier_id)->firstOrFail();
		//$prls = Prl::with('item')->where('pr_id', $pr->id)->get()->all();

		//$prls = Prl::where('pr_id', $id)->firstOrFail();
		//$prls = Prl::getLinesByPrId($id);
		//$prls = Prl::By_pr_id($id);
		//$prls = Prl::where('pr_id', $id)->firstOrFail();
		//dd($id, $prls);

		$data = [
			'title' => 'Company XYZ',
			'id' => $payment->id,
			'date' => date('m/d/Y'),
			'setup' => $setup,
			'payment' => $payment,
			'invoice' => $invoice,
			'account' => $account,
		];

		
		$pdf = PDF::loadView('landlord.reports.formats.receipt', $data);
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

		//$canvas->page_text($x, $y, $text, $font, 55, $color, 2, 2, -30);

		return $pdf->stream('receipt.pdf');
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
}
