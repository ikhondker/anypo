<?php

namespace App\Http\Controllers\Tenant\Lookup;

use App\Http\Controllers\Controller;

use App\Models\Tenant\Lookup\BankAccount;
use App\Http\Requests\Tenant\Lookup\StoreBankAccountRequest;
use App\Http\Requests\Tenant\Lookup\UpdateBankAccountRequest;

# Models
# Enums
# Helpers
use App\Helpers\Export;
use App\Helpers\EventLog;
# Notifications
# Mails
# Packages
# Seeded
use DB;
use Illuminate\Support\Facades\Log;
# Exceptions
# Events

class BankAccountController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->authorize('viewAny',BankAccount::class);

		$bank_accounts = BankAccount::query();
		if (request('term')) {
			$bank_accounts->where('ac_name', 'Like', '%' . request('term') . '%');
		}
		$bank_accounts = $bank_accounts->orderBy('id', 'DESC')->paginate(10);
		return view('tenant.lookup.bank-accounts.index', compact('bank_accounts'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{	
		$this->authorize('create', BankAccount::class);
		
		return view('tenant.lookup.bank-accounts.create');
		
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreBankAccountRequest $request)
	{
		$this->authorize('create', BankAccount::class);
		
		$bankAccount = BankAccount::create($request->all());
		// Write to Log
		EventLog::event('bankAccount', $bankAccount->id, 'create');

		return redirect()->route('bank-accounts.index')->with('success', 'Bank Account created successfully.');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(BankAccount $bankAccount)
	{
		$this->authorize('view', $bankAccount);

		return view('tenant.lookup.bank-accounts.show', compact('bankAccount'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(BankAccount $bankAccount)
	{
		$this->authorize('update', $bankAccount);

		return view('tenant.lookup.bank-accounts.edit', compact('bankAccount'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateBankAccountRequest $request, BankAccount $bankAccount)
	{
		$this->authorize('update', $bankAccount);

		//$request->validate();
		$request->validate([
		]);
		$bankAccount->update($request->all());

		// Write to Log
		EventLog::event('bankAccount', $bankAccount->id, 'update', 'name', $request->ac_name);

		return redirect()->route('bank-accounts.index')->with('success', 'Bank Account updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(BankAccount $bankAccount)
	{
		$this->authorize('delete', $bankAccount);

		$bankAccount->fill(['enable' => ! $bankAccount->enable]);
		$bankAccount->update();
		// Write to Log
		EventLog::event('dept', $bankAccount->id, 'status', 'enable', $bankAccount->enable);

		return redirect()->route('bank-accounts.index')->with('success', 'Dept status changed successfully');
	}

	public function export()
	{

		$this->authorize('export', BankAccount::class);

		$data = DB::select("
		SELECT id, ac_name, ac_number, bank_name, branch_name, start_date, end_date, currency, contact_person, cell, address1, address2, city, zip, state, country, website, email, IF(enable, 'Yes', 'No') as Enable, created_by, created_at, updated_by, updated_at FROM bank_accounts
			");
		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('bank-accounts', $dataArray);
	}
}
