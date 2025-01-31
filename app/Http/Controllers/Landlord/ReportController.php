<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			ReportController copy.php
* @brief		This file contains the implementation of the ReportController copy
* @path			\app\Http\Controllers\Landlord
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

// test/

namespace App\Http\Controllers\Landlord;

use App\Http\Controllers\Controller;
use App\Http\Requests\Landlord\StoreReportRequest;
use App\Http\Requests\Landlord\UpdateReportRequest;

# 1. Models
use App\Models\User;
use App\Models\Landlord\Report;
use App\Models\Landlord\Account;

use App\Helpers\Watermark;

use App\Models\Landlord\Ticket;
use App\Models\Landlord\Comment;
use App\Models\Landlord\Admin\Payment;
use App\Models\Landlord\Admin\Invoice;
use App\Models\Landlord\Manage\Config;
# 2. Enums
# 3. Helpers
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


class ReportController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		//
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

	public function viewPdfInvoice(Invoice $invoice)
	{

		//Log::debug('storage_path() = '.storage_path());

		//Log::info(json_encode($invoice));


		// NOTE: Uses InvoicePolicy
		$this->authorize('pdfInvoice', $invoice);

		$config = Config::first();

		//dd($invoice);
		//$invoice = Invoice::with('status','owner')->where('id', $id)->firstOrFail();

		$account = Account::where('id', $invoice->account_id)->firstOrFail();
		//dd($payment);
		//$config = Config::where('id', config('akk.SETUP_ID'))->firstOrFail();
		//$pr = Pr::with('requestor')->where('id', $id)->firstOrFail();
		//$supplier = Supplier::where('id', $pr->supplier_id)->firstOrFail();
		//$prls = Prl::with('item')->where('pr_id', $pr->id)->get()->all();

		//$prls = Prl::where('pr_id', $id)->firstOrFail();
		//$prls = Prl::getLinesByPrId($id);
		//$prls = Prl::By_pr_id($id);
		//$prls = Prl::where('pr_id', $id)->firstOrFail();
		//dd($id, $prls);

		$data = [
			'id' 		=> $invoice->id,
			'date' 		=> date('m/d/Y'),
			'config' 	=> $config,
			'invoice' 	=> $invoice,
			'account' 	=> $account,
		];

		$pdf = PDF::loadView('landlord.reports.formats.invoice', $data);
			// ->setOption('fontDir', public_path('/fonts/lato'));

		Watermark::set($pdf, $invoice->status->name,'P');

		return $pdf->stream('Invoice'.$invoice->id.'.pdf');
	}


	public function viewPdfPayment(Payment $payment)
	{

		// NOTE: Uses PaymentPolicy
		$this->authorize('pdfPayment', $payment);

		$config = Config::first();

		$invoice = Invoice::where('id', $payment->invoice_id)->firstOrFail();
		$account = Account::where('id', $payment->account_id)->firstOrFail();
		$data = [
			'id' 		=> $payment->id,
			'date' 		=> date('m/d/Y'),
			'config' 	=> $config,
			'payment' 	=> $payment,
			'invoice' 	=> $invoice,
			'account' 	=> $account,
		];

		$pdf = PDF::loadView('landlord.reports.formats.receipt', $data);


		Watermark::set($pdf, $payment->status->name,'P');

		return $pdf->stream('receipt.pdf');
	}


	public function viewPdfTicket(Ticket $ticket)
	{

		// NOTE: Uses InvoicePolicy
		$this->authorize('pdfTicket', $ticket);

		$config = Config::first();
		//$payment = Payment::where('id', $id)->firstOrFail();
		$ticket = Ticket::where('id', $ticket->id)->firstOrFail();
		$owner = User::where('id', $ticket->owner_id)->firstOrFail();
		//$account = Account::where('id', $ticket->account_id)->firstOrFail();


		if (auth()->user()->isBackend()) {
			$comments = Comment::with('owner')->where('ticket_id', $ticket->id)->orderBy('id', 'desc')->get()->all();
		} else {
			// Hide internal comments form user
			$comments = Comment::with('owner')->where('ticket_id', $ticket->id)->where('is_internal', false)->orderBy('id', 'desc')->get()->all();
		}

		$data = [

			'id' 		=> $ticket->id,
			'date' 		=> date('m/d/Y'),
			'config' 	=> $config,
			'ticket' 	=> $ticket,
			'comments' 	=> $comments,
			'owner' 	=> $owner,
		//	'account' 	=> $account,
		];

		$pdf = PDF::loadView('landlord.reports.formats.ticket', $data);

		Watermark::set($pdf, $ticket->status->name,'P');

		return $pdf->stream('ticket.pdf');
	}

}
