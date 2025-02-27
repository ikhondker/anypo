<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			ProcessController.php
* @brief		This file contains the implementation of the ProcessController
* @path			\app\Http\Controllers\Landlord\Manage
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

namespace App\Http\Controllers\Landlord\Manage;

use App\Http\Controllers\Controller;

use App\Models\Landlord\Manage\Process;
use App\Http\Requests\Landlord\Manage\StoreProcessRequest;
use App\Http\Requests\Landlord\Manage\UpdateProcessRequest;

# 1. Models
# 2. Enums
# 3. Helpers
# 4. Notifications
# 5. Jobs
use App\Jobs\Landlord\ProcessBilling;
use App\Jobs\Landlord\AccountsArchive;
# 6. Mails
# 7. Rules
# 8. Packages
# 9. Exceptions
# 10. Events
# 11. Controller
# 12. Seeded
use Str;
use Illuminate\Support\Facades\Log;
# 13. FUTURE

class ProcessController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$this->authorize('viewAny', Process::class);
		$processes = Process::query();
		if (request('term')) {
			$processes->where('id', 'Like', '%'.request('term').'%');
		}
		$processes = $processes->orderBy('id', 'ASC')->paginate(40);

		return view('landlord.manage.processes.index', compact('processes'));


	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$this->authorize('create', Process::class);
		return view('landlord.manage.processes.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\StoreProcessRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreProcessRequest $request)
	{
		abort(403);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Process  $process
	 * @return \Illuminate\Http\Response
	 */
	public function show(Process $process)
	{
		abort(403);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Process  $process
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Process $process)
	{
		abort(403);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Http\Requests\UpdateProcessRequest  $request
	 * @param  \App\Models\Process  $process
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateProcessRequest $request, Process $process)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Process  $process
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Process $process)
	{
		//
	}


	public function updateService()
	{
		abort(403);
		//return redirect()->route('processes.index')->with('success', 'Process run successfully.');
	}

	public function genInvoiceAll()
	{
		// Run process
		Log::debug('landlord.process.genInvoiceAll Running process to generate all invoices.');
		Log::debug('landlord.process.genInvoiceAll Dispatch job ProcessBilling.');
		ProcessBilling::dispatch();
		return redirect()->route('processes.index')->with('success','Invoice Generation Process submitted successfully.');
	}

	public function accountsArchive()
	{
		abort(403);
		// TODOP2
		//Log::debug('landlord.process.accountsArchive Running process to generate all invoices.');
		//AccountsArchive::dispatch();
		//return redirect()->route('processes.index')->with('success','Accounts Archive Process submitted successfully.');
	}
}
