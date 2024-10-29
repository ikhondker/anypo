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
use App\Models\Tenant\Manage\CustomError;
use App\Models\Tenant\Po;
use App\Models\Tenant\Pol;
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
# 9. Exceptions
# 10. Events
# 11. Controller
# 12. Seeded
use DB;
use Illuminate\Support\Facades\Log;
# 13. FUTURE
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

		Log::debug('tenant.PolController.addLine po_id = ' . $po->id);

		if ($po->auth_status <> AuthStatusEnum::DRAFT->value) {
		 	return redirect()->route('pos.show',$po->id)->with('error', 'You can only add line to Purchase Order with status '. strtoupper(AuthStatusEnum::DRAFT->value) .' !');
		}

		$this->authorize('update',$po);	// << =============

		$items = Item::primary()->get();
		$uoms = Uom::primary()->get();

		$pols = Pol::with('item')->with('uom')->where('po_id', $po->id)->get()->all();

		return view('tenant.pols.create', with(compact('po','pols','items','uoms')));
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
		// old $result = Po::updatePoHeaderValue($pol->po_id);
		// 	Update PR Header value and Populate functional currency values
		Log::debug('tenant.prl.store calling syncPrValues for pr_id = '. $pol->po_id);
		$result = Po::syncPoValues($pol->po_id);
		Log::debug('tenant.prl.store syncPrValues return value = '. $result);

		if ($result == '') {
			Log::debug('tenant.ppl.store syncPpValues completed.');
		} else {
			$customError = CustomError::where('code', $result)->first();
			Log::error(tenant('id'). 'tenant.pol.store syncPoValues po_id = '.$pol->po_id. ' ERROR_CODE = '.$customError->code.' Error Message = '.$customError->message);
		}

		// $pol_sum 			= Pol::where('po_id', '=', $po->id)->sum('amount');
		// $po->amount			= $pol_sum;
		// $po->save();

		if($request->has('add_row')) {
			//Checkbox checked
			return redirect()->route('pols.add-line', $pol->po_id)->with('success', 'Line added to PO #'. $pol->po_id.' successfully.');
			//return redirect()->route('pols.createline', $po->id)->with('success', 'PO #'. $po->id.' created successfully. Please add more line.');
		} else {
			//Checkbox not checked
			return redirect()->route('pos.show', $pol->po_id)->with('success', 'Lined added to PO #'. $pol->po_id.' successfully.');
			//return redirect()->route('pos.show', $po->id)->with('success', 'PO #'. $po->id.' created successfully.');
		}

	}

	/**
	 * Display the specified resource.
	 */
	public function show(Pol $pol)
	{
		$this->authorize('view', $pol);

		$po = Po::where('id', $pol->po_id)->first();
		$pols = Pol::where('po_id', $pol->po_id)->get();
		//dd($pols);
		return view('tenant.pols.show', compact('po','pol','pols'));
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

		$pols = Pol::with('item')->with('uom')->where('po_id', $pol->po_id)->get()->all();

		return view('tenant.pols.edit', with(compact('po','pols', 'pol', 'items','uoms')));
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

		// Write to Log
		EventLog::event('pol', $pol->id, 'update', 'summary', $pol->summary);
		EventLog::event('Pol', $pol->id, 'edit');
		$pol->update($request->all());

		// 	update PO Header value
		// old 	$result = Po::updatePoHeaderValue($pol->po_id);

		$result = Po::syncPoValues($pol->po_id);
		Log::debug('tenant.PolController.update Return value of Po->syncPoValues = ' . $result);
		if ($result == '') {
			Log::debug('tenant.pol.update syncPoValues completed.');
		} else {
			$customError = CustomError::where('code', $result)->first();
			Log::error(tenant('id'). 'tenant.po.update syncPoValues po_id = '.$pol->po_id. ' ERROR_CODE = '.$customError->code.' Error Message = '.$customError->message);
		}


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
		$result = Po::syncPoValues($pol->po_id);

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

	public function ael(Pol $pol)
	{
		$this->authorize('view', $pol);

		$po = Po::where('id', $pol->po_id)->get()->firstOrFail();
		return view('tenant.pols.ael', compact('po','pol'));
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
		pol.line_num, pol.item_description, i.code item_code, uom.name uom, pol.qty, pol.price, pol.sub_total, pol.tax, pol.gst, pol.amount,
		pol.price, pol.sub_total, pol.amount,pol.notes, pol.closure_status
		FROM pos po,depts d, projects p, suppliers s, users u , , items i, uoms uom
		WHERE po.dept_id=d.id
		AND po.project_id=p.id
		AND po.supplier_id=s.id
		AND po.requestor_id=u.id
		AND po.id = pol.pr_id
		AND pol.item_id = i.id
		AND pol.uom_id = uom.id
		AND ". ($dept_id <> '' ? 'po.dept_id = '.$dept_id.' ' : ' 1=1 ') ."
		AND ". ($requestor_id <> '' ? 'po.requestor_id = '.$requestor_id.' ' : ' 1=1 ') ."
		");


		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('pos', $dataArray);
	}

	public function getPol($polId = 0)
	{

		//http://demo1.localhost:8000/pols/get-pol/1005

		$sql = "
			SELECT  p.id po_id, p.currency,
			p.summary po_summary, DATE_FORMAT(p.po_date,'%d-%b-%Y') po_date, FORMAT(p.amount,2) po_amount,p.currency po_currency,
			uom.name uom_name, FORMAT(pol.qty,2) qty, FORMAT(pol.received_qty,2) received_qty,
			d.name dept_name,prj.name project_name, u.name buyer_name,
			s.name supplier_name
			FROM pols pol, uoms uom, pos p, suppliers s, depts d, projects prj, users u
			WHERE 1=1
			AND pol.po_id = p.id
			AND pol.uom_id=uom.id
			AND p.supplier_id = s.id
			AND p.dept_id = d.id
			AND p.project_id = prj.id
			AND p.buyer_id = u.id
			AND pol.id = '".$polId."'
		";

		Log::debug('id=' . $sql);
		$result = DB::selectOne($sql);
		return response()->json([
			'po_id'             => $result->po_id,
			'po_currency'       => $result->currency,
			'po_summary'        => $result->po_summary,
			'po_date'           => $result->po_date,
			'po_amount'         => $result->po_amount,
			'pol_uom_name'      => $result->uom_name,
			'pol_qty'           => $result->qty,
			'pol_received_qty'  => $result->received_qty,
			'dept_name'         => $result->dept_name,
			'project_name'      => $result->project_name,
			'buyer_name'        => $result->buyer_name,
			'supplier_name'     => $result->supplier_name
		]);

	}

}
