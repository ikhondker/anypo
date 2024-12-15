<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			BankAccountController.php
* @brief		This file contains the implementation of the BankAccountController
* @path			\App\Http\Controllers\Tenant\Lookup
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

namespace App\Http\Controllers\Tenant\Lookup;

use App\Http\Controllers\Controller;

use App\Models\Tenant\Lookup\BankAccount;
use App\Http\Requests\Tenant\Lookup\StoreBankAccountRequest;
use App\Http\Requests\Tenant\Lookup\UpdateBankAccountRequest;

# 1. Models
# 2. Enums
# 3. Helpers
use App\Helpers\Export;
use App\Helpers\EventLog;
# 4. Notifications
# 5. Jobs
# 6. Mails
# 7. Rules
# 8. Packages
# 9. Exceptions
# 10. Events
# 11. Controller
# 12. Seeded
use DB;
use Str;
use Illuminate\Support\Facades\Log;
# 13. FUTURE

class BankAccountController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->authorize('viewAny',BankAccount::class);

		$bankAccounts = BankAccount::query();
		if (request('term')) {
			$bankAccounts->where('ac_name', 'Like', '%' . request('term') . '%');
		}
		$bankAccounts = $bankAccounts->orderBy('id', 'DESC')->paginate(10);
		return view('tenant.lookup.bank-accounts.index', compact('bankAccounts'));
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


		$request->merge([
			'state' 	=> Str::upper($request['state']),
			'ac_bank' 	=> Str::upper($request['ac_bank']),
		]);


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
	 * Display the specified resource.
	 */
	public function timestamp(BankAccount $bankAccount)
	{
		$this->authorize('view', $bankAccount);

		return view('tenant.lookup.bank-accounts.timestamp', compact('bankAccount'));
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

		$request->merge([
			'state' 	=> Str::upper($request['state']),
			'ac_bank' 	=> Str::upper($request['ac_bank']),
		]);


		//$request->validate();
		$request->validate([
		]);

		// Write to Log
		EventLog::event('bankAccount', $bankAccount->id, 'update', 'name', $request->ac_name);
		$bankAccount->update($request->all());

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
		EventLog::event('bankAccount', $bankAccount->id, 'status', 'enable', $bankAccount->enable);

		return redirect()->route('bank-accounts.index')->with('success', 'Bank Account status changed successfully');
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
