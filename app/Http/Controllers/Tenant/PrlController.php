<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			PrlController.php
* @brief		This file contains the implementation of the PrlController
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


use App\Http\Requests\Tenant\StorePrlRequest;
use App\Http\Requests\Tenant\UpdatePrlRequest;

# 1. Models
use App\Models\Tenant\Lookup\Item;
use App\Models\Tenant\Lookup\Uom;
use App\Models\Tenant\Manage\CustomError;
use App\Models\Tenant\Pr;
use App\Models\Tenant\Prl;
# 2. Enums
use App\Enum\Tenant\AuthStatusEnum;
use App\Enum\UserRoleEnum;
# 3. Helpers
use App\Helpers\Export;
use App\Helpers\EventLog;
# 4. Notifications
# 5. Jobs
# 6. Mails
# 7. Rules
# 8. Packages
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
# 9. Exceptions
# 10. Events
# 11. Controller
# 12. Seeded
use DB;
use Illuminate\Support\Facades\Log;
# 13. FUTURE


class PrlController extends Controller
{
	/**
	 * Show the form for creating a new resource.
	 *
	 * @param  \App\Models\Prl  $prl
	 * @return \Illuminate\Http\Response
	 */
	public function addLine(Pr $pr)
	{

		$this->authorize('update',$pr);	// << =============

		$items = Item::primary()->get();
		//$uoms = Uom::getAllClient();
		$uoms = Uom::primary()->get();


		$prls = Prl::with('item')->with('uom')->where('pr_id', $pr->id)->get()->all();

		return view('tenant.prls.create', with(compact('pr','prls','items','uoms')));
	}


	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->authorize('viewAny', Prl::class);

		$prls = Prl::query();
		if (request('term')) {
			$prls->where('name', 'Like', '%'.request('term').'%');
		}
		$prls = $prls->orderBy('id', 'DESC')->paginate(10);

		return view('tenant.prls.index', compact('prls'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		abort(403);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StorePrlRequest $request)
	{
		$this->authorize('create', Prl::class);

		// get max line num for the
		$line_num 						= Prl::where('pr_id', '=',$request->input('pr_id'))->max('line_num');
		$request->merge(['line_num'		=> $line_num +1]);

		$request->merge(['sub_total'	=> $request->input('qty') * $request->input('price')]);
		$request->merge(['tax'			=> $request->input('tax')]);
		$request->merge(['gst'			=> $request->input('gst')]);
		$request->merge(['amount'		=> ($request->input('qty')*$request->input('price'))+$request->input('tax')+ $request->input('gst') ]);

		//$request->merge(['sub_total'	=> $request->input('sub_total')]);
		//$request->merge(['pr_date'	=> date('Y-m-d H:i:s')]);
		$prl = Prl::create($request->all());

		// Write to Log
		EventLog::event('Prl', $prl->id, 'create');

		// 	Update PR Header value and Populate functional currency values
		Log::debug('tenant.prl.store calling syncPrValues for pr_id = '. $prl->pr_id);
		$result = Pr::syncPrValues($prl->pr_id);
		Log::debug('tenant.prl.store syncPrValues return value = '. $result);

		if ($result == '') {
			Log::debug('tenant.prl.store syncPrValues completed.');
		} else {
			$customError = CustomError::where('code', $result)->first();
			Log::error(tenant('id'). 'tenant.prl.store syncPrValues pr_id = '.$prl->pr_id. ' ERROR_CODE = '.$customError->code.' Error Message = '.$customError->message);
			//return redirect()->route('prs.index')->with('error', 'Exchange Rate not found for today. System will automatically import it in background. Please try after sometime.');
		}


		if($request->has('add_row')) {
			//Checkbox checked
			return redirect()->route('prls.add-line', $prl->pr_id)->with('success', 'Line added to PR #'. $prl->pr_id.' successfully.');
		} else {
			//Checkbox not checked
			return redirect()->route('prs.show', $prl->pr_id)->with('success', 'Lined added to PR #'. $prl->pr_id.' successfully.');
		}

		// switch ($request->input('action')) {
		// 	case 'save':
		// 		return redirect()->route('prs.show', $prl->pr_id)->with('success', 'PR #'. $prl->pr_id.' created successfully.');
		// 		break;
		// 	case 'save_add':
		// 		return redirect()->route('prls.add-line', $prl->pr_id)->with('success', 'PR #'. $prl->pr_id.' created successfully. Please add more line.');
		// 		break;
		// }

		//return redirect()->route('prs.show', $prl->pr_id)->with('success', 'Requisition line added successfully');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Prl $prl)
	{
		abort(403);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Prl $prl)
	{

		$this->authorize('update', $prl);

		// Write Event Log
		//LogEvent('template',$template->id,'edit','template',$template->id);

		$pr = Pr::where('id', $prl->pr_id)->first();
		$items = Item::primary()->get();
		$uoms = Uom::primary()->get();

		$prls = Prl::with('item')->with('uom')->where('pr_id', $prl->pr_id)->get()->all();

		return view('tenant.prls.edit', with(compact('pr', 'prls', 'prl', 'items','uoms')));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdatePrlRequest $request, Prl $prl)
	{
		$this->authorize('update', $prl);

		//$request->merge(['sub_total'	=> $request->input('prl_amount')]);
		//$request->merge(['amount'		=> $request->input('sub_total')+$request->input('tax')+$request->input('gst')]);
		//$request->merge(['sub_total'	=> $request->input('qty') * $request->input('price')]);
		//$request->merge(['tax'			=> $request->input('tax')]);
		//$request->merge(['gst'			=> $request->input('gst')]);
		//$request->merge(['amount'		=> ($request->input('qty')*$request->input('price'))+$request->input('tax')+ $request->input('gst') ]);

		//$request->validate();
		$request->validate([

		]);
		// Write to Log
		EventLog::event('prl', $prl->id, 'update', 'summary', $prl->summary);
		$prl->update($request->all());

		// 	Update PR Header value and Populate functional currency values. Currency Might change
		Log::debug('tenant.prl.update calling syncPrValues for pr_id = '. $prl->pr_id);
		$result = Pr::syncPrValues($prl->pr_id);
		Log::debug('tenant.prl.update syncPrValues return value = '. $result);

		if ($result == '') {
			Log::debug('tenant.prl.update syncPrValues completed.');
		} else {
			$customError = CustomError::where('code', $result)->first();
			Log::error(tenant('id'). 'tenant.prl.update syncPrValues pr_id = '.$prl->pr_id. ' ERROR_CODE = '.$customError->code.' Error Message = '.$customError->message);
		}



		return redirect()->route('prs.show', $prl->pr_id)->with('success', 'PR Line updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Prl $prl)
	{

		$pr = Pr::where('id', $prl->pr_id)->first();

		if ($pr->auth_status <> AuthStatusEnum::DRAFT->value) {
			return redirect()->route('prs.show',$pr->id)->with('error', 'You can delete line in Requisition with only status '. strtoupper($pr->auth_status) .' !');
		}

		Log::debug('tenant.prl.destroy deleting pr_id = '. $prl->pr_id);
		// check if allowed by policy
		$this->authorize('delete', $prl);

		$prl->delete();

		// 	update PR Header value
		Log::debug('tenant.prl.destroy calling syncPrValues for pr_id = '. $prl->pr_id);
		$result = Pr::syncPrValues($prl->pr_id);
		Log::debug('tenant.prl.destroy syncPrValues return value = '. $result);

		if ($result == '') {
			Log::debug('tenant.prl.destroy syncPrValues completed.');
		} else {
			$customError = CustomError::where('code', $result)->first();
			Log::error(tenant('id'). 'tenant.prl.destroy syncPrValues pr_id = '.$prl->pr_id. ' ERROR_CODE = '.$customError->code.' Error Message = '.$customError->message);
		}

		// Write to Log
		EventLog::event('prl', $prl->id, 'delete', 'id', $prl->id);

		return redirect()->route('prs.show', $prl->pr_id)->with('success', 'PR Line deleted successfully');
	}


}
