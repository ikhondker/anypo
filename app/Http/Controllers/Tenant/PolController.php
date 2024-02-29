<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			PolController.php
* @brief		This file contains the implementation of the PolController
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


use App\Http\Requests\Tenant\StorePolRequest;
use App\Http\Requests\Tenant\UpdatePolRequest;

# 1. Models
use App\Models\Tenant\Lookup\Item;
use App\Models\Tenant\Lookup\Uom;

use App\Models\Tenant\Po;
use App\Models\Tenant\Pol;
# 2. Enums
use App\Enum\AuthStatusEnum;
use App\Enum\UserRoleEnum;
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
use Illuminate\Support\Facades\Log;
# 13. TODO 
# 1. cancel pol


class PolController extends Controller
{
	/**
	 * Show the form for creating a new resource.
	 *
	 * @param  \App\Models\Pol  $pol
	 * @return \Illuminate\Http\Response
	 */
	public function addLine(Po $po)
	{

		if ($po->auth_status <> AuthStatusEnum::DRAFT->value) {
		 	return redirect()->route('pos.show',$po->id)->with('error', 'You can only add line to Purchase Order with status '. strtoupper(AuthStatusEnum::DRAFT->value) .' !');
		}

		$this->authorize('update',$po);	// << =============

		$items = Item::primary()->get();
		//$uoms = Uom::getAllClient();
		$uoms = Uom::primary()->get();

		return view('tenant.pols.create', with(compact('po','items')));
	}


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
	public function store(StorePolRequest $request)
	{
		$this->authorize('create', Pol::class);
		
		// get Po detail 
		$po 				= Po::where('id', $request->input('po_id'))->firstOrFail();

		//dd($po);
		// get max line num for the
		$line_num 						= Pol::where('po_id', '=',$po->id)->max('line_num');
		$request->merge(['line_num'		=> $line_num +1]);
		$request->merge(['dept_id'		=> $po->dept_id]);
		$request->merge(['requestor_id'	=> $po->requestor_id]);
		//$request->merge(['pr_date'	=> date('Y-m-d H:i:s')]);

		$request->merge(['sub_total'	=> $request->input('qty') * $request->input('price')]);
		$request->merge(['tax'			=> $request->input('tax')]);
		$request->merge(['gst'			=> $request->input('gst')]);
		$request->merge(['amount'		=> ($request->input('qty')*$request->input('price'))+$request->input('tax')+ $request->input('gst') ]);



		$pol = Pol::create($request->all());

		// Write to Log
		EventLog::event('Pol', $pol->id, 'create');

		// update PO Header value
		$result = Po::updatePoHeaderValue($pol->po_id);
		

		// $pol_sum 			= Pol::where('po_id', '=', $po->id)->sum('amount');
		// $po->amount			= $pol_sum;
		// $po->save();
		
		switch ($request->input('action')) {
			case 'save':
				return redirect()->route('pos.show', $po->id)->with('success', 'PO #'. $po->id.' created successfully.');
				break;
			case 'save_add':
				return redirect()->route('pols.createline', $po->id)->with('success', 'PO #'. $po->id.' created successfully. Please add more line.');
				break;
		}


		//return redirect()->route('pos.show', $pol->po_id)->with('success', 'Purchase Order line added successfully');

	}

	/**
	 * Display the specified resource.
	 */
	public function show(Pol $pol)
	{
		$this->authorize('view', $pol);
		return view('tenant.pols.show', compact('pol'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Pol $pol)
	{
		$this->authorize('update', $pol);
		// Write Event Log
		//LogEvent('template',$template->id,'edit','template',$template->id);

		$po = Po::where('id', $pol->po_id)->first();

		if ($po->auth_status <> AuthStatusEnum::DRAFT->value) {
			return redirect()->route('pos.show',$po->id)->with('error', 'You can not edit a Purchase Order with status '. strtoupper($po->auth_status) .' !');
		}
		
		$items = Item::primary()->get();
		$uoms = Uom::primary()->get();

		return view('tenant.pols.edit', with(compact('po', 'pol', 'items','uoms')));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdatePolRequest $request, Pol $pol)
	{
		$this->authorize('update', $pol);

		$request->merge(['sub_total'	=> $request->input('qty') * $request->input('price')]);
		$request->merge(['tax'			=> $request->input('tax')]);
		$request->merge(['gst'			=> $request->input('gst')]);
		$request->merge(['amount'		=> ($request->input('qty')*$request->input('price'))+$request->input('tax')+ $request->input('gst') ]);

		//$request->validate();
		$request->validate([

		]);
		$pol->update($request->all());

		// Write to Log
		EventLog::event('Pol', $pol->id, 'edit');

		// 	update PO Header value
		$result = Po::updatePoHeaderValue($pol->po_id);

		// Write to Log
		EventLog::event('pol', $pol->id, 'update', 'summary', $pol->summary);

		return redirect()->route('pos.show', $pol->po_id)->with('success', 'Purchase Order Line updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Pol $pol)
	{
		$po = Po::where('id', $pol->po_id)->first();

		if ($po->auth_status <> AuthStatusEnum::DRAFT->value) {
			return redirect()->route('pos.show',$po->id)->with('error', 'You can delete line in PO with only status '. strtoupper($pr->auth_status) .' !');
		}

		$this->authorize('delete', $pol);

		$pol->delete();

		// 	update PR Header value
		$result = Po::updatePoHeaderValue($pol->po_id);

		// Write to Log
		EventLog::event('pol', $pol->id, 'delete', 'id', $pol->id);

		return redirect()->route('pos.show', $pol->po_id)->with('success', 'PO Line deleted successfully');
	}

	public function receipt(Pol $pol)
	{
		$this->authorize('view', $pol);

		//$po = Po::where('id', $po->id)->get()->firstOrFail();
		return view('tenant.pols.receipt', compact('pol'));
	}


	public function export()
	{

		$this->authorize('export', Pol::class);

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
		SELECT po.id, po.summary po_summary, po.po_date, po.need_by_date, u.name requestor, d.name dept_name,p.name project_name, s.name supplier_name, 
		po.notes, po.currency, po.amount, po.status, po.auth_status, po.auth_date,
		pol.line_num, pol.summary line_summary, i.code item_code, uom.name uom, pol.qty, pol.price, pol.sub_total, pol.tax, pol.gst, pol.amount,
		pol.price, pol.sub_total, pol.amount,pol.notes, pol.closure_status
		FROM pos po,depts d, projects p, suppliers s, users u , , items i, uoms uom
		WHERE po.dept_id=d.id 
		AND po.project_id=p.id 
		AND po.supplier_id=s.id 
		AND po.requestor_id=u.id
		AND po.id = pol.pr_id 
		AND pol.item_id = i.id
		AND pol.uom_id = uom.id
		AND ". ($dept_id <> '' ? 'po.dept_id='.$dept_id.' ' : ' 1=1 ')  ."
		AND ". ($requestor_id <> '' ? 'po.requestor_id='.$requestor_id.' ' : ' 1=1 ')  ."
		");

		
		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('pos', $dataArray);
	}

}
