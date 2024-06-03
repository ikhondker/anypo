<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			InvoiceController.php
* @brief		This file contains the implementation of the InvoiceController
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

use App\Models\User;

use App\Models\Tenant\Invoice;
use App\Http\Requests\Tenant\StoreInvoiceRequest;
use App\Http\Requests\Tenant\UpdateInvoiceRequest;

# 1. Models
use App\Models\Tenant\Po;
use App\Models\Tenant\DeptBudget;
use App\Models\Tenant\Payment;
use App\Models\Tenant\Lookup\Project;
use App\Models\Tenant\Admin\Setup;
use App\Models\Tenant\Lookup\Supplier;
# 2. Enums
use App\Enum\EntityEnum;
use App\Enum\EventEnum;
use App\Enum\UserRoleEnum;
use App\Enum\InvoiceStatusEnum;
use App\Enum\ClosureStatusEnum;
use App\Enum\PaymentStatusEnum;
use App\Enum\AuthStatusEnum;
# 3. Helpers
use App\Helpers\Export;
use App\Helpers\EventLog;
use App\Helpers\FileUpload;
use App\Helpers\ExchangeRate;
# 4. Notifications
# 5. Jobs
use App\Jobs\Tenant\ConsolidateBudget;
use App\Jobs\Tenant\RecordDeptBudgetUsage;
use App\Jobs\Tenant\AehInvoice;

# 6. Mails
# 7. Rules
use App\Rules\Tenant\OverInvoiceRule;
# 8. Packages
# 9. Exceptions
# 10. Events
# 11. Controller
# 12. Seeded
use DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Validator;
use Str;
use Illuminate\Foundation\Http\FormRequest;
use Exception;
# 13. FUTURE

class InvoiceController extends Controller
{

	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->authorize('viewAny', Invoice::class);

		$invoices = Invoice::query();
		if (request('term')) {
			$invoices->where('invoice_no', 'Like', '%' . request('term') . '%');
		}
		switch (auth()->user()->role->value) {
            case UserRoleEnum::HOD->value:
                $invoices = $invoices->with('supplier')->with('status_badge')->with('pay_status_badge')->ByPoDept(auth()->user()->dept_id)->paginate(10);
                break;
			case UserRoleEnum::BUYER->value:
				// buyer can see all invoice of all his po's
				//$invoices = $invoices->with('supplier')->with('status_badge')->with('pay_status_badge')->ByPoBuyer(auth()->user()->id)->paginate(10);
				//break;
			case UserRoleEnum::CXO->value:
			case UserRoleEnum::ADMIN->value:
			case UserRoleEnum::SYSTEM->value:
				$invoices = $invoices->with('supplier')->with('status_badge')->with('pay_status_badge')->orderBy('id', 'DESC')->paginate(10);
				break;
			default:
				//$invoices = $invoices->with('supplier')->with('status_badge')->with('pay_status_badge')->ByUserAll()->paginate(10);
				Log::warning(tenant('id'). 'tenant.invoice.index Other role = '. auth()->user()->role->value);
				abort(403);
		}
		return view('tenant.invoices.index', compact('invoices'));
	}


    /**
	 * Display a listing of the resource.
	 */
	public function myInvoices()
	{

        $this->authorize('viewAny', Invoice::class);

		$invoices = Invoice::query();
		if (request('term')) {
			$invoices->where('invoice_no', 'Like', '%' . request('term') . '%');
		}
		$invoices = $invoices->with('supplier')->with('status_badge')->with('pay_status_badge')->ByPoBuyer(auth()->user()->id)->paginate(10);

        return view('tenant.pos.my-invoices', compact('invoices'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create(Po $po)
	{

		$this->authorize('create', Invoice::class);

		$setup 	= Setup::first();
		if ($setup->readonly ){
			return redirect()->route('dashboards.index')->with('error', config('akk.MSG_READ_ONLY'));
		}
		// check if po is approved and open
		if ($po->auth_status <> AuthStatusEnum::APPROVED->value) {
			return redirect()->route('pos.show', $po->id)->with('error', 'You can create Invoices only for APPROVED Purchase Order!');
		}

		if ($po->status <> ClosureStatusEnum::OPEN->value) {
			return redirect()->route('pos.show', $po->id)->with('error', 'You can create Invoices only for OPEN Purchase Order!');
		}

		Log::debug('tenant.invoices.create creating invoice for po_id = ' . $po->id);
		//$po = Po::where('id', $po_id)->first();
		$pocs	= User::Tenant()->get();

		return view('tenant.invoices.create-for-po', with(compact('po','pocs')));
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreInvoiceRequest $request)
	{
		$this->authorize('create', Invoice::class);

		// get PO
		$po = Po::where('id', $request->input('po_id'))->first();

		// Check over invoice
		$request->validate([
			'amount' => [new OverInvoiceRule ($po->id)],
		]);


		$request->merge([
			'currency' 		=> $po->currency,
			'invoice_no' 	=> Str::upper($request['invoice_no']),
			'supplier_id'	=> 	$po->supplier_id
		]);


		// $request->merge(['invoice_date'		=> date('Y-m-d H:i:s')]);
		$invoice = Invoice::create($request->all());

		if ($file = $request->file('file_to_upload')) {
			$request->merge(['article_id'	=> $invoice->id ]);
			$request->merge(['entity'		=> EntityEnum::INVOICE->value ]);
			$attid = FileUpload::aws($request);
		}




		// Write to Log
		EventLog::event('invoice', $invoice->id, 'create');
		return redirect()->route('invoices.show',$invoice->id)->with('success', 'Invoice created successfully. Please POST the invoice.');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Invoice $invoice)
	{

		$this->authorize('view', $invoice);

		return view('tenant.invoices.show', compact('invoice'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Invoice $invoice)
	{
		$this->authorize('update', $invoice);

		if ($invoice->status <> InvoiceStatusEnum::DRAFT->value) {
			return redirect()->route('invoices.show',$invoice->id)->with('error', 'You can not edit a Invoice with status '. strtoupper($invoice->status) .' !');
		}

		//$depts = Dept::primary()->get();

		//$suppliers = Supplier::primary()->get();
		//$projects = Project::primary()->get();
		//$users = User::tenant()->get();
		$po = Po::where('id', $invoice->po_id)->first();
		$pocs	= User::Tenant()->get();

		return view('tenant.invoices.edit', compact('invoice', 'po', 'pocs'));

	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateInvoiceRequest $request, Invoice $invoice)
	{
		$this->authorize('update', $invoice);

		// get PO
		$po = Po::where('id', $invoice->po_id)->first();

		// check over invoiced
		$request->validate([
			'amount' => [new OverInvoiceRule ($po->id)],
		]);

		// User and HoD Can not edit department PR
		if ( auth()->user()->role->value == UserRoleEnum::USER->value || auth()->user()->role->value == UserRoleEnum::HOD->value ) {
			$request->merge(['dept_id'		=> auth()->user()->dept_id]);
		}

		$request->merge([
			'invoice_no' => Str::upper($request['invoice_no']),
		]);
		$invoice->update($request->all());

		// Write to Log
		EventLog::event('invoice', $invoice->id, 'update', 'summary', $invoice->summary);
		return redirect()->route('invoices.show', $invoice->id)->with('success', 'Invoices updated successfully.');
	}

	// add attachments
	public function attach(FormRequest $request)
	{
		$this->authorize('create', Invoice::class);

		// allow add attachment only if status is draft
		try {
			$invoice = Invoice::where('id', $request->input('attach_invoice_id'))->get()->firstOrFail();
		} catch (Exception $e) {
			Log::error(tenant('id'). ' tenant.invoice.attach user_id = '. auth()->user()->id.' request = '. $request. ' class = '.get_class($e). ' Message = '. $e->getMessage());
			return redirect()->back()->with(['error' => 'Invoice not Found!']);
		}
		if ($invoice->status <> InvoiceStatusEnum::DRAFT->value){
			return redirect()->route('invoices.show', $invoice->id)->with('error', 'Add attachment is only allowed for DRAFT requisition.');
		}

		if ($file = $request->file('file_to_upload')) {
			$request->merge(['article_id'	=> $request->input('attach_invoice_id') ]);
			$request->merge(['entity'		=> EntityEnum::INVOICE->value ]);
			$attid = FileUpload::aws($request);
		}

		return redirect()->route('invoices.show', $request->input('attach_invoice_id'))->with('success', 'File Uploaded successfully.');
	}

	public function attachments(Invoice $invoice)
	{
		$this->authorize('view', $invoice);

		$invoice = Invoice::where('id', $invoice->id)->get()->firstOrFail();
		//$attachments = Attachment::with('owner')->where('entity', EntityEnum::PR->value)->where('article_id', $invoice->id)->get();
		//return view('tenant.invoices.attachments', compact('invoice', 'attachments'));
		return view('tenant.invoices.attachments',compact('invoice'));
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function post(Invoice $invoice)
	{
		$this->authorize('post', $invoice);

		if ($invoice->status <> InvoiceStatusEnum::DRAFT->value) {
			//return redirect()->route('pos.cancel')->with('error', 'Please delete DRAFT Requisition if needed!');
			return back()->withError("You can only post DRAFT Invoices!")->withInput();
		}

		// update budget and project level summary
		$po = Po::where('id', $invoice->po_id)->first();
		if ($po->status <> ClosureStatusEnum::OPEN->value) {
			return redirect()->route('pos.show', $po->id)->with('error', 'You can post Invoices only for OPEN Purchase Order!');
		}

		// Check over invoice
		$un_invoiced_amount = $po->amount - $po->amount_invoice;
		if ( $invoice->amount > ($un_invoiced_amount) ){
			return redirect()->route('invoices.show', $invoice->id)->with('error', 'You can not create Invoice larger than the remaining un-invoiced amount i.e. '. number_format($un_invoiced_amount,2).' '. $po->currency);
		}

		$invoice->fill(['status' => InvoiceStatusEnum::POSTED->value]);


		$invoice->update();
		// P2 if final invoice Close po

		// 	Populate functional currency values
		$result = self::updateInvoiceFcValues($invoice->id);
		if (! $result) {
			return redirect()->route('pos.index')->with('error', 'Exchange Rate not found for today. System will automatically import it in background. Please try after sometime.');
		}

		// Reupload
		$invoice = Invoice::where('id', $invoice->id)->first();

		// Po dept budget grs amount update
		$dept_budget = DeptBudget::primary()->where('id', $po->dept_budget_id)->firstOrFail();
		$dept_budget->amount_invoice = $dept_budget->amount_invoice + $invoice->fc_amount;
		$dept_budget->count_invoice = $dept_budget->count_invoice + 1;
		$dept_budget->save();

		// Project update amount_invoice
		$project = Project::where('id', $po->project_id)->firstOrFail();
		$project->amount_invoice = $project->amount_invoice + $invoice->fc_amount;
		$project->count_invoice = $project->count_invoice + 1;
		$project->save();

		// Supplier update amount_invoice
		$supplier = Supplier::where('id', $po->supplier_id)->firstOrFail();
		$supplier->amount_invoice = $supplier->amount_invoice + $invoice->fc_amount;
		$supplier->count_invoice 	= $supplier->count_invoice + 1;
		$supplier->save();

		// PO header update
		$po->amount_invoice = $po->amount_invoice + $invoice->amount;
		$po->fc_amount_invoice = $po->fc_amount_invoice + $invoice->fc_amount;
		$po->save();

		// run job to Sync Budget
		RecordDeptBudgetUsage::dispatch(EntityEnum::INVOICE->value, $invoice->id, EventEnum::POST->value, $invoice->fc_amount);
		ConsolidateBudget::dispatch($dept_budget->budget_id);

		// Create Accounting for this Invoice
		AehInvoice::dispatch($invoice->id, $invoice->fc_amount);

		// Write to Log
		EventLog::event('invoice', $invoice->id, 'post');

		return redirect()->route('invoices.index')->with('success', 'Invoice Posted successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Invoice $invoice)
	{
		//
	}



	/**
	 * Remove the specified resource from storage.
	 */
	public function cancel(Invoice $invoice)
	{

		$this->authorize('cancel', Invoice::class);

		$invoice_id = $invoice->id;

		try {
			$invoice = Invoice::where('id', $invoice_id)->firstOrFail();

			if ($invoice->payment_status <> PaymentStatusEnum::DUE->value) {
				return back()->withError("You can not cancel a paid Invoice! Please void Payments first!")->withInput();
			}

			$sum_payments			= Payment::where('invoice_id',$invoice_id)->sum('amount');
			if ($sum_payments <> 0) {
				return back()->withError("Payment Exists! Please void Payments first!")->withInput();
			}

			// update budget and project level summary
			$po = Po::where('id', $invoice->po_id)->first();

			// update budget and project level summary
			$po = Po::where('id', $invoice->po_id)->first();
			if ($po->status <> ClosureStatusEnum::OPEN->value) {
				return redirect()->route('pos.show', $po->id)->with('error', 'You can cancel Invoices only for OPEN Purchase Order!');
			}

			// Po dept budget grs amount update
			$dept_budget 					= DeptBudget::primary()->where('id', $po->dept_budget_id)->firstOrFail();
			$dept_budget->amount_invoice 	= $dept_budget->amount_invoice - $invoice->fc_amount;
			$dept_budget->count_invoice 	= $dept_budget->count_invoice -1;
			$dept_budget->save();

			// Reduce project amount_invoice
			$project 					= Project::where('id', $po->project_id)->firstOrFail();
			$project->amount_invoice 	= $project->amount_invoice - $invoice->fc_amount;
			$project->count_invoice 	= $project->count_invoice -1;
			$project->save();

			// Reduce Supplier amount_invoice
			$supplier 					= Supplier::where('id', $po->supplier_id)->firstOrFail();
			$supplier->amount_invoice 	= $supplier->amount_invoice - $invoice->fc_amount;
			$supplier->count_invoice 	= $supplier->count_invoice -1;
			$supplier->save();

			// Reverse PO Invoiced amount
			$po 						= Po::where('id', $invoice->po_id)->firstOrFail();
			$po->amount_invoice			= $po->amount_invoice - $invoice->amount;
			$po->fc_amount_invoice		= $po->fc_amount_invoice - $invoice->fc_amount;
			$po->save();

			// run job to Sync Budget
			RecordDeptBudgetUsage::dispatch(EntityEnum::INVOICE->value, $invoice->id, EventEnum::CANCEL->value, $invoice->fc_amount);
			ConsolidateBudget::dispatch($dept_budget->budget_id);

			// Create Reverse Accounting for this Invoice
			AelInvoice::dispatch($invoice->id, $invoice->fc_amount, true);

			// cancel Invoice
			Invoice::where('id', $invoice->id)
				->update([
					'sub_total' 	=> 0,
					'tax' 			=> 0,
					'gst' 			=> 0,
					'amount' 		=> 0,
					'fc_sub_total' 	=> 0,
					'fc_tax' 		=> 0,
					'fc_gst' 		=> 0,
					'fc_amount' 	=> 0,
					'paid_amount' 	=> 0,
					'status' 		=> InvoiceStatusEnum::CANCELED->value
				]);

			// Write to Log
			EventLog::event('invoice', $invoice->id, 'cancel', 'id', $invoice->id);

			return redirect()->route('invoices.index')->with('success', 'Invoice canceled successfully.');

		} catch (ModelNotFoundException $exception) {
			// Error handling code
			return back()->withError("Invoice #".$invoice_id." not Found!")->withInput();
		}
	}

	// populate functions currency columns in PO header nad lines
	public static function updateInvoiceFcValues($receipt_id)
	{

		$setup 			= Setup::first();
		$invoice		= Invoice::with('po')->where('id', $receipt_id)->firstOrFail();
		Log::debug('tenant.InvoiceController.updateInvoiceFcValues receipt_id = ' . $receipt_id);
		Log::debug('tenant.InvoiceController.updateInvoiceFcValues invoice_id = ' . $invoice->id);
		Log::debug('tenant.InvoiceController.updateInvoiceFcValues invoice->currency = ' . $invoice->currency);
		Log::debug('tenant.InvoiceController.updateInvoiceFcValues setup->currency = ' . $setup->currency);

		// populate fc columns for receipt lines
		if ($invoice->currency == $setup->currency){
			$rate = 1;
			DB::statement("UPDATE invoices SET
				fc_sub_total	= sub_total,
				fc_tax			= tax,
				fc_gst			= gst,
				fc_amount		= amount
				WHERE id = ".$invoice->id."");
		} else {
			$rate = round(ExchangeRate::getRate($invoice->currency, $setup->currency),6);
			// update all pols fc columns
			// update invoice fc columns
			// ERROR rate not found
			if ($rate == 0){
				Log::error(tenant('id'). 'receipt.updateInvoiceFcValues rate not found currency = ' . $invoice->currency.' fc_currency = '.$setup->currency);
				return false;
			}

			DB::statement("UPDATE invoices SET
				fc_sub_total	= round(sub_total * ". $rate .",2),
				fc_tax			= round(tax * ". $rate .",2),
				fc_gst			= round(gst * ". $rate .",2),
				fc_amount		= round(amount * ". $rate .",2)
				WHERE id = ".$invoice->id."");
		}

		return true;
	}

	public function ael(Invoice $invoice)
	{
		$this->authorize('view', $invoice);

		$po = Po::where('id', $invoice->po_id)->get()->firstOrFail();

		return view('tenant.invoices.ael', compact('po','invoice'));
	}


	public function export()
	{

		$this->authorize('export', Invoice::class);

		if (auth()->user()->role->value == UserRoleEnum::USER->value ){
			$requestor_id 	= auth()->user()->id;
		} else {
			$requestor_id 	= '';
		}

		if (auth()->user()->role->value == UserRoleEnum::HOD->value){
			$dept_id 	= auth()->user()->dept_id;
		} else {
			$dept_id 	= '';
		}

		$data = DB::select("
		SELECT i.id, i.invoice_no, i.invoice_date,
				i.po_id po_id,
				s.name supplier_name,
				i.summary, u.name poc_name,
				i.currency, i.sub_total, i.tax, i.gst, i.amount, i.paid_amount,
				i.fc_exchange_rate, i.fc_sub_total, i.fc_tax, i.fc_gst, i.fc_amount, i.fc_paid_amount,
				i.notes, i.status, i.payment_status
			FROM invoices i, pos po, suppliers s, users u
			WHERE i.po_id =p.id
			AND i.supplier_id= s.id
			AND i.poc_id = u.id
			AND ". ($dept_id <> '' ? 'po.dept_id = '.$dept_id.' ' : ' 1=1 ') ."
			AND ". ($requestor_id <> '' ? 'po.requestor_id='.$requestor_id.' ' : ' 1=1 ') ."
			");
		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('depts', $dataArray);
	}

}
