<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			PaymentController.php
* @brief		This file contains the implementation of the PaymentController
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

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;

use App\Models\Tenant\Payment;
use App\Http\Requests\Tenant\StorePaymentRequest;
use App\Http\Requests\Tenant\UpdatePaymentRequest;

# 1. Models
use App\Models\Tenant\Po;
use App\Models\Tenant\Invoice;
use App\Models\Tenant\DeptBudget;
use App\Models\Tenant\Lookup\Project;
use App\Models\Tenant\Lookup\BankAccount;
use App\Models\Tenant\Admin\Setup;
use App\Models\Tenant\Lookup\Supplier;
# 2. Enums
use App\Enum\UserRoleEnum;
use App\Enum\Tenant\EntityEnum;
use App\Enum\Tenant\EventEnum;
use App\Enum\Tenant\PaymentStatusEnum;
use App\Enum\Tenant\InvoiceStatusEnum;
use App\Enum\Tenant\ClosureStatusEnum;
# 3. Helpers
use App\Helpers\Tenant\FileUpload;
use App\Helpers\Tenant\ExchangeRate;
use App\Helpers\EventLog;
# 4. Notifications
# 5. Jobs
use App\Jobs\Tenant\ConsolidateBudget;
use App\Jobs\Tenant\RecordDeptBudgetUsage;
use App\Jobs\Tenant\AehPayment;
use App\Jobs\Tenant\CloseInvoice;
# 6. Mails
# 7. Rules
use App\Rules\Tenant\OverPaymentRule;
# 8. Packages
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
# 9. Exceptions
# 10. Events
# 11. Controller
# 12. Seeded
use DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
# 13. FUTURE


class PaymentController extends Controller
{

	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->authorize('viewAny', Payment::class);

		$payments = Payment::query();
		if (request('term')) {
			$payments->where('name', 'Like', '%' . request('term') . '%');
		}
		switch (auth()->user()->role->value) {
			case UserRoleEnum::HOD->value:
				$payments = $payments->with('bank_account')->with('payee')->with('status_badge')->ByPoDept(auth()->user()->dept_id)->paginate(10);
				break;
			case UserRoleEnum::BUYER->value:
			case UserRoleEnum::CXO->value:
			case UserRoleEnum::ADMIN->value:
			case UserRoleEnum::SYSTEM->value:
				$payments = $payments->with('invoice.supplier')->with('bank_account')->with('payee')->with('status_badge')->orderBy('id', 'DESC')->paginate(10);
				break;
			default:
				//$payments = $payments->with('bank_account')->with('payee')->with('status_badge')->ByUserAll()->paginate(10);
				Log::warning(tenant('id'). 'tenant.payment.index Other role = '. auth()->user()->role->value);
				abort(403);
		}
		return view('tenant.payments.index', compact('payments'));
	}

		/**
	 * Display a listing of the resource.
	 */
	public function myPayments()
	{

		$this->authorize('viewAny', Payment::class);

		$payments = Payment::query();
		if (request('term')) {
			$payments->where('name', 'Like', '%' . request('term') . '%');
		}
		$payments = $payments->with('invoice.supplier')->with('bank_account')->with('payee')->with('status_badge')->ByCreator()->paginate(10);
		return view('tenant.payments.my-payments', compact('payments'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		abort(403);
	}


	/**
	 * Show the form for creating a new resource.
	 */
	public function createForInvoice(Invoice $invoice = null)
	{

		$this->authorize('createForInvoice', Payment::class);

		$setup 	= Setup::first();
		if ($setup->readonly ){
			return redirect()->route('dashboards.index')->with('error', config('akk.MSG_READ_ONLY'));
		}

		$bank_accounts = BankAccount::primary()->get();

		if(empty($invoice)){
			Log::debug('tenant.PaymentController.createForInvoice No Invoice Selected!');

			$invoices = Invoice::paymentDue()->get();
			return view('tenant.payments.create-for-invoice', with(compact('invoice','invoices','bank_accounts')));
		} else {

			Log::debug('tenant.PaymentController.createForInvoice Creating payment for invoice id = ' . $invoice->id);

			// check if invoice is posted
			if ($invoice->status <> InvoiceStatusEnum::POSTED->value) {
				//return redirect()->route('pos.cancel')->with('error', 'Please delete DRAFT Requisition if needed!');
				return back()->withError("You can only Pay POSTED Invoices!")->withInput();
			}

			$po = Po::where('id', $invoice->po_id)->first();
			if ($po->status <> ClosureStatusEnum::OPEN->value) {
				return redirect()->route('pos.show', $po->id)->with('error', 'You can make Payment only for OPEN Purchase Orders!');
			}

			return view('tenant.payments.create-for-invoice', with(compact('po','invoice','bank_accounts')));
		}

	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StorePaymentRequest $request)
	{
		$this->authorize('createForInvoice', Payment::class);

		// populate po_id in payment to simplify coding
		$invoice = Invoice::where('id', $request->input('invoice_id'))->first();

		// check if invoice is posted (if direct creation)
		if ($invoice->status <> InvoiceStatusEnum::POSTED->value) {
			//return redirect()->route('pos.cancel')->with('error', 'Please delete DRAFT Requisition if needed!');
			return back()->withError("You can only Pay POSTED Invoices!")->withInput();
		}

		// check if PO is open (if direct creation)
		$po = Po::where('id', $invoice->po_id)->first();
		if ($po->status <> ClosureStatusEnum::OPEN->value) {
			return redirect()->route('pos.show', $po->id)->with('error', 'You can make Payment only for OPEN Purchase Orders!');
		}

		// Check over Payment
		$request->validate([
			'amount' => [new OverPaymentRule ( $request->input('invoice_id'))],
		]);

		$request->merge(['payment_date'		=> date('Y-m-d H:i:s')]);
		$request->merge(['payee_id'			=> 	auth()->user()->id ]);
		$request->merge(['po_id'			=> $invoice->po_id ]);
		$request->merge(['currency'			=> $invoice->currency ]);
		$payment = Payment::create($request->all());

		if ($file = $request->file('file_to_upload')) {
			$request->merge(['article_id'	=> $payment->id ]);
			$request->merge(['entity'		=> EntityEnum::PAYMENT->value ]);
			$attid = FileUpload::aws($request);
		}

		// 	Populate functional currency values
		$result = self::updatePaymentFcValues($payment->id);
		if (! $result) {
			return redirect()->route('pos.index')->with('error', 'Exchange Rate not found for today. System will automatically import it in background. Please try after sometime.');
		}
		// Reupload
		$payment = Payment::with('invoice')->where('id', $payment->id)->firstOrFail();
		// Create Accounting for this Payment
		AehPayment::dispatch($payment->id, $payment->fc_amount);


		// update Invoice header
		$invoice 				= Invoice::where('id', $payment->invoice_id)->firstOrFail();
		$invoice->amount_paid	= $invoice->amount_paid + $payment->amount;
		$invoice->fc_amount_paid= $invoice->fc_amount_paid + $payment->fc_amount;

		if ($invoice->amount_paid == $invoice->amount){
			$invoice->payment_status 	= PaymentStatusEnum::PAID->value;
		} // else {
			//$invoice->payment_status	= PaymentStatusEnum::PARTIAL->value;
			//}
		$invoice->save();

		// update budget and project level summary
		$po = Po::where('id', $payment->invoice->po_id)->first();

		// PO header update
		$po->amount_paid 	= $po->amount_paid + $payment->amount;
		$po->fc_amount_paid = $po->fc_amount_paid + $payment->fc_amount;
		$po->save();

		// Po dept budget grs amount update
		$dept_budget = DeptBudget::primary()->where('id', $po->dept_budget_id)->firstOrFail();
		$dept_budget->amount_payment = $dept_budget->amount_payment + $payment->fc_amount;
		$dept_budget->count_payment = $dept_budget->count_payment + 1 ;
		$dept_budget->save();

		// Po project budget used
		$project = Project::where('id', $po->project_id)->firstOrFail();
		$project->amount_payment = $project->amount_payment + $payment->fc_amount;
		$project->count_payment = $project->count_payment + 1 ;
		$project->save();

		// Supplier update amount_payment
		$supplier = Supplier::where('id', $po->supplier_id)->firstOrFail();
		$supplier->amount_payment = $supplier->amount_payment + $payment->fc_amount;
		$supplier->count_payment 	= $supplier->count_payment + 1;
		$supplier->save();


		// run job to Sync Budget
		RecordDeptBudgetUsage::dispatch(EntityEnum::PAYMENT->value, $payment->id, EventEnum::CREATE->value, $payment->fc_amount);
		ConsolidateBudget::dispatch($dept_budget->budget_id);

		// Create Accounting for this Invoice
		AehPayment::dispatch($payment->id, $payment->fc_amount);

		Log::debug('tenant.dashboards.index Submitting CloseInvoice::dispatch() for payment_id = '.$payment->id);
		CloseInvoice::dispatch($payment->id);

		// Write to Log
		EventLog::event('payment', $payment->id, 'create');

		//return redirect()->route('payments.show',$payment->id)->with('success', 'Payment created successfully.');
		return redirect()->route('payments.show',$payment->id)->with('success', 'Payment created successfully.');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Payment $payment)
	{
		$this->authorize('view', $payment);
		//$invoice 				= Invoice::where('id', $payment->invoice_id)->firstOrFail();

		//return view('tenant.payments.show', compact('payment','invoice'));
		return view('tenant.payments.show', compact('payment'));
	}

	/**
	 * Display the specified resource.
	 */
	public function timestamp(Payment $payment)
	{
		$this->authorize('view', $payment);

		return view('tenant.payments.timestamp', compact('payment'));
	}

	public function ael(Payment $payment)
	{
		$this->authorize('view', $payment);
		//$invoice = Invoice::where('id', $payment->invoice_id)->get()->firstOrFail();
		//$po = Po::where('id', $invoice->po_id)->get()->firstOrFail();
		return view('tenant.payments.ael', compact('payment'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Payment $payment)
	{
		abort(403);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdatePaymentRequest $request, Payment $payment)
	{
		abort(403);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Payment $payment)
	{
		abort(403);
	}



	/**
	 * Remove the specified resource from storage.
	 */
	// public function cancel(StorePaymentRequest $request)
	public function cancel(Payment $payment)
	{
		$this->authorize('cancel',Payment::class);

		$payment_id = $payment->id;

		try {
			$payment = Payment::where('id', $payment_id)->firstOrFail();

			if ($payment->status <> PaymentStatusEnum::PAID->value) {
				return back()->withError("You can only cancel payment with status paid!")->withInput();
			}

			// Get Invoice
			$invoice 				= Invoice::where('id', $payment->invoice_id)->firstOrFail();

			// update budget and project level summary
			$po = Po::where('id', $invoice->po_id)->first();
			if ($po->status <> ClosureStatusEnum::OPEN->value) {
				return redirect()->route('pos.show', $po->id)->with('error', 'You can cancel Invoices only for OPEN Purchase Order!');
			}

			// Reverse Invoice Payment
			$invoice->amount_paid	= $invoice->amount_paid - $payment->amount;
			$invoice->save();

			// Po dept budget grs amount update
			$dept_budget = DeptBudget::primary()->where('id', $po->dept_budget_id)->firstOrFail();
			$dept_budget->amount_payment = $dept_budget->amount_payment - $payment->fc_amount;
			$dept_budget->count_payment = $dept_budget->count_payment - 1 ;
			$dept_budget->save();

			// Po project budget used
			$project = Project::where('id', $po->project_id)->firstOrFail();
			$project->amount_payment = $project->amount_payment - $payment->fc_amount;
			$project->count_payment = $project->count_payment - 1 ;
			$project->save();

			// Reduce Supplier amount_payment
			$supplier = Supplier::where('id', $po->supplier_id)->firstOrFail();
			$supplier->amount_payment = $supplier->amount_payment - $payment->fc_amount;
			$supplier->count_payment = $supplier->count_payment -1;
			$supplier->save();

			// run job to Sync Budget
			RecordDeptBudgetUsage::dispatch(EntityEnum::PAYMENT->value, $payment->id, EventEnum::CANCEL->value, $payment->fc_amount);
			ConsolidateBudget::dispatch($dept_budget->budget_id);

			// Create Reverse Accounting for this Receipt
			AehPayment::dispatch($payment->id, $payment->fc_amount, true);

			// cancel Payment
			Payment::where('id', $payment->id)
				->update([
					'amount' => 0,
					'fc_amount' => 0,
					'status' => PaymentStatusEnum::CANCELED->value
				]);

			Log::debug('tenant.dashboards.index Submitting CloseInvoice::dispatch() for payment_id = '.$payment->id);
			CloseInvoice::dispatch($payment->id);

			// Write to Log
			EventLog::event('payment', $payment->id, 'void', 'id', $payment->id);
			return redirect()->route('payments.index')->with('success', 'Payment canceled successfully.');

		} catch (ModelNotFoundException $exception) {
			// Error handling code
			return back()->withError("Payment #".$payment_id." not Found!")->withInput();
		}
	}

	// populate functions currency columns in PO header nad lines
	public static function updatePaymentFcValues($payment_id)
	{
		$setup 			= Setup::first();
		$payment		= Payment::where('id', $payment_id)->firstOrFail();

		Log::debug('tenant.PaymentController.updatePaymentFcValues payment_id = ' . $payment_id);
		Log::debug('tenant.PaymentController.updatePaymentFcValues payment->currency = ' . $payment->currency);
		Log::debug('tenant.PaymentController.updatePaymentFcValues setup->currency = ' . $setup->currency);


		// populate fc columns for receipt lines
		if ($payment->currency == $setup->currency){
			$rate = 1;
			DB::statement("UPDATE payments SET
				fc_amount		= amount
				WHERE id = ".$payment->id."");
		} else {
			$rate = round(ExchangeRate::getRate($payment->currency, $setup->currency),6);
			// update all pols fc columns
			// update pr fc columns
			// ERROR rate not found
			if ($rate == 0){
				Log::error('receipt.updatePaymentFcValues rate not found currency = ' . $payment->currency.' fc_currency = '.$setup->currency);
				return false;
			}

			DB::statement("UPDATE payments SET
				fc_amount		= round(amount * ". $rate .",2)
				WHERE id = ".$payment->id."");
		}
		return true;
	}



}
