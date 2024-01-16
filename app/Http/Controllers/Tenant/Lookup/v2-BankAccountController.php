<?php
namespace App\Http\Controllers\Tenant\Lookup;

use App\Http\Controllers\Controller;


use App\Models\Tenant\Lookup\BankAccount;
use App\Http\Requests\Tenant\Lookup\StoreBankAccountRequest;
use App\Http\Requests\Tenant\Lookup\UpdateBankAccountRequest;

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
			$bankAccounts->where('ac_name', 'Like', '%' . request('term') . '%');
		}
		$bank_accounts = $bank_accounts->orderBy('id', 'DESC')->paginate(10);
		return view('tenant.lookup.bank-accounts.index', compact('bank_accounts'))->with('i', (request()->input('page', 1) - 1) * 10);
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
	public function store(StoreBankAccountRequest $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 */
	public function show(BankAccount $bankAccount)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(BankAccount $bankAccount)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateBankAccountRequest $request, BankAccount $bankAccount)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(BankAccount $bankAccount)
	{
		//
	}
}
