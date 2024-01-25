<?php

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;


use App\Models\Tenant\Receipt;
use App\Http\Requests\Tenant\StoreReceiptRequest;
use App\Http\Requests\Tenant\UpdateReceiptRequest;

# Models
use App\Models\Tenant\Po;
use App\Models\Tenant\Pol;
use App\Models\Tenant\Lookup\Warehouse;

# Enums
use App\Enum\EntityEnum;
use App\Enum\UserRoleEnum;
use App\Enum\ReceiptStatusEnum;
# Helpers
use App\Helpers\EventLog;
use App\Helpers\Export;
use App\Helpers\FileUpload;
# Notifications
# Mails
# Packages
# Seeded
use DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
# Exceptions
# Events


class ReceiptController extends Controller
{
	/**
	 * Show the form for creating a new resource.
	 *
	 * @param  \App\Models\Pol  $pol
	 * @return \Illuminate\Http\Response
	 */
	public function createForPol($pol_id)
	{
		$this->authorize('create', Receipt::class);

		$pol = Pol::where('id', $pol_id)->first();
		$po = Po::where('id', $pol->po_id)->first();
		$warehouses = Warehouse::primary()->get();

		return view('tenant.receipts.create-for-pol', with(compact('po','pol','warehouses')));
	}


	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->authorize('viewAny',Receipt::class);

		$receipts = Receipt::query();
		if (request('term')) {
			$receipts->where('name', 'Like', '%' . request('term') . '%');
		}

		switch (auth()->user()->role->value) {
			case UserRoleEnum::BUYER->value:
				// buyer can see all payment of all his po's
				$receipts = $receipts->ByPoBuyer(auth()->user()->id)->paginate(10);
				break;
			case UserRoleEnum::HOD->value:
				$receipts = $receipts->ByPoDept(auth()->user()->dept_id)->paginate(10);
				break;
			case UserRoleEnum::CXO->value:
			case UserRoleEnum::ADMIN->value:
			case UserRoleEnum::SYSTEM->value:
				$receipts = $receipts->orderBy('id', 'DESC')->paginate(10);
				break;
			default:
				$receipts = $receipts->ByUserAll()->paginate(10);
				Log::debug("payment.index Other roles!");
		}

		//$receipts = $receipts->orderBy('id', 'DESC')->paginate(10);
		return view('tenant.receipts.index', compact('receipts'))->with('i', (request()->input('page', 1) - 1) * 10);
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
	public function store(StoreReceiptRequest $request)
	{
		$this->authorize('create', Receipt::class);

		$request->merge(['receiver_id'	=> 	auth()->user()->id ]);
		$receipt = Receipt::create($request->all());

		// update POl rcv quantity
		$pol 				= Pol::where('id', $receipt->pol_id)->firstOrFail();
		$pol->received_qty	= $pol->received_qty + $receipt->qty;
		$pol->save();

		if ($file = $request->file('file_to_upload')) {
			$request->merge(['article_id'	=> $payment->id ]);
			$request->merge(['entity'		=> EntityEnum::RECEIPT->value ]);
			$attid = FileUpload::upload($request);
		}

		// Write to Log
		EventLog::event('receipt', $receipt->id, 'create');
		return redirect()->route('receipts.index')->with('success', 'Receipt created successfully.');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Receipt $receipt)
	{
		$this->authorize('view', $receipt);
		return view('tenant.receipts.show', compact('receipt'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Receipt $receipt)
	{
		//$this->authorize('update', $dept);
		//return view('tenant.depts.edit', compact('dept'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateReceiptRequest $request, Receipt $receipt)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Receipt $receipt)
	{
		$this->authorize('delete', $dept);

		$dept->fill(['enable' => !$dept->enable]);
		$dept->update();

		// Write to Log
		EventLog::event('dept', $dept->id, 'status', 'enable', $dept->enable);

		return redirect()->route('depts.index')->with('success', 'Dept status Updated successfully');
	}

	public function export()
	{
		$this->authorize('export', Receipt::class);

		$data = DB::select("SELECT id, receive_date, rcv_type, pol_id, warehouse_id, receiver_id, qty, notes, status, created_by, created_at, updated_by, updated_at, FROM receipts
		");
		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('receipts', $dataArray);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function getCancelGrnNum()
	{

		$this->authorize('cancel',Receipt::class);
		
		return view('tenant.receipts.cancel');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function cancel(StoreReceiptRequest $request)
	{
		
		$this->authorize('cancel',Receipt::class);
		$receipt_id = $request->input('receipt_id');

		try {
			$receipt = Receipt::where('id', $receipt_id)->firstOrFail();

			if ($receipt->status <> ReceiptStatusEnum::RECEIVED->value) {
				return back()->withError("You can only cancel Receipt with status received!")->withInput();
			}
	
			// update POL rcv quantity
			$pol 				= Pol::where('id', $receipt_id)->firstOrFail();
			$pol->received_qty	= $pol->received_qty - $receipt->qty;
			$pol->save();
			
			// Cancel Receipt
			Receipt::where('id', $receipt_id)
				->update(['status' => ReceiptStatusEnum::CANCELED->value]);
		
			// Write to Log
			EventLog::event('Receipt', $receipt_id, 'cancel', 'id', $receipt_id);
	
			return redirect()->route('receipts.index')->with('success', 'Receipts canceled successfully.');
		
		} catch (ModelNotFoundException $exception) {
			// Error handling code
			return back()->withError("Receipt #".$receipt_id." not Found!")->withInput();
		}
	}

}
