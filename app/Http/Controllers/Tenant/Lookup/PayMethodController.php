<?php

namespace App\Http\Controllers\Tenant\Lookup;

use App\Http\Controllers\Controller;


// 1. Enums
// 2. Helpers
use App\Helpers\EventLog;
use App\Helpers\Export;
// 3. Notifications
// 4. Mails
// 5. Packages
// 6. Requests
use App\Http\Requests\Tenant\Lookup\StorePayMethodRequest;
use App\Http\Requests\Tenant\Lookup\UpdatePayMethodRequest;
// 7. Exceptions
// 8. Events
// 9. Models
use App\Models\Tenant\Lookup\Currency;
use App\Models\Tenant\Lookup\PayMethod;
// 10. Seeded
use DB;
use Illuminate\Support\Facades\Log;

class PayMethodController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$pay_methods = PayMethod::query();
		if (request('term')) {
			$pay_methods->where('name', 'Like', '%' . request('term') . '%');
		}
		$pay_methods = $pay_methods->orderBy('id', 'DESC')->paginate(10);
		return view('tenant.lookup.pay-methods.index', compact('pay_methods'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$this->authorize('create', PayMethod::class);
		$currencies = Currency::primary()->get();

		return view('tenant.lookup.pay-methods.create', compact('currencies'));
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StorePayMethodRequest $request)
	{
		$this->authorize('create', PayMethod::class);

		$payMethod = PayMethod::create($request->all());
		// Write to Log
		EventLog::event('payMethod', $payMethod->id, 'create');

		return redirect()->route('pay-methods.index')->with('success', 'PayMethod created successfully.');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(PayMethod $payMethod)
	{
		//$this->authorize('view', $payMethod);
		return view('tenant.lookup.pay-methods.show', compact('payMethod'));

	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(PayMethod $payMethod)
	{
		$this->authorize('update', $payMethod);
		return view('tenant.lookup.pay-methods.edit', compact('payMethod'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdatePayMethodRequest $request, PayMethod $payMethod)
	{
		$this->authorize('update', $payMethod);

		//$request->validate();
		$request->validate([

		]);
		$payMethod->update($request->all());

		return redirect()->route('pay-methods.index')->with('success', 'PayMethod updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(PayMethod $payMethod)
	{
		$this->authorize('delete', $payMethod);

		$payMethod->fill(['enable' => ! $payMethod->enable]);
		$payMethod->update();

		// Write to Log
		EventLog::event('payMethod', $payMethod->id, 'status', 'enable', $payMethod->enable);

		return redirect()->route('pay-methods.index')->with('success', 'PayMethod status Updated successfully');
	}

	public function export()
	{
		$data = DB::select("SELECT id, name, pay_method_number, bank_name, branch_name, start_date, end_date, currency, 
			notes, IF(enable, 'Yes', 'No') as Enable
			FROM pay_methods");
		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('pay_methods', $dataArray);
	}

}
