<?php


/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			ExportController.php
* @brief		This file contains the implementation of the ExportController
* @path			\App\Http\Controllers\Tenant
* @author		Iqbal H. Khondker <ihk@khondker.com>
* @created		4-JAN-2024
* @copyright	(c) Iqbal H. Khondker <ihk@khondker.com>
* =====================================================================================
* Revision History:
* Date			Version	Author				Comments
* -------------------------------------------------------------------------------------
* 24-DEC-2024	v1.0	Iqbal H Khondker	Created
* DD-MON-YYYY	v1.1	Iqbal H Khondker	Modification brief
* =====================================================================================
*/


namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;

use App\Models\Tenant\Export;
use App\Http\Requests\Tenant\StoreExportRequest;
use App\Http\Requests\Tenant\UpdateExportRequest;

class ExportController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->authorize('viewAny',Export::class);

		$exports = Export::query();
		if (request('term')) {
			$exports->where('name', 'Like', '%'.request('term').'%');
		}
		if(auth()->user()->role->value == UserRoleEnum::SYSTEM->value) {
			$exports = $exports->orderBy('order_by1', 'ASC')->orderBy('order_by2', 'ASC')->paginate(100);
			return view('tenant.exports.all', compact('exports'));
		} else {
			$exports = $exports->where('enable', true)->orderBy('order_by1', 'ASC')->orderBy('order_by2', 'ASC')->paginate(100);
			return view('tenant.exports.index', compact('exports'));
		}
	}

		/**
	 * Show the form for editing the specified resource.
	 */
	public function parameter(Export $export)
	{
		$depts 			= Dept::Primary()->get();
		$suppliers 		= Supplier::Primary()->get();
		$projects 		= Project::Primary()->get();
		$warehouses 	= Warehouse::Primary()->get();
		$bank_accounts 	= BankAccount::Primary()->get();
		$pms 			= User::Tenant()->get();
		//$report_id='1003';
		return view('tenant.exports.parameters', compact('report','depts','suppliers','projects','warehouses','bank_accounts','pms'));
	}


	/**
	 * Update the specified resource in storage.
	 */
	public function run(UpdateReportRequest $request, Export $report)
	{

		//$report_id		= $request->input('report_id');
		$article_id			= $request->input('article_id');
		$start_date			= $request->input('start_date');
		$end_date			= $request->input('end_date');
		$dept_id			= $request->input('dept_id');
		$supplier_id		= $request->input('supplier_id');
		$project_id			= $request->input('project_id');
		$warehouse_id		= $request->input('warehouse_id');
		$bank_account_id	= $request->input('bank_account_id');
		$pm_id				= $request->input('pm_id');

		Log::debug('tenant.report.run article_id = '.$article_id);
		Log::debug('tenant.report.run start_date = '.$start_date);
		Log::debug('tenant.report.run end_date = '.$end_date);
		Log::debug('tenant.report.run pm_id = '.$pm_id);

		Log::debug('tenant.report.run report_code = '.$report->code);

		// Increase exports run_count -------------------------
		self::increaseRunCounter(Str::lower($report->code));


		// article_id validation
		if ($report->article_id_required){
			try {
				switch ($report->entity) {
					case EntityEnum::PR->value:
						$pr = Pr::where('id', $article_id)->firstOrFail();
						break;
					case EntityEnum::PO->value:
						$po = Po::where('id', $article_id)->firstOrFail();
						break;
					case EntityEnum::INVOICE->value:
						$invoice = Invoice::where('id', $article_id)->firstOrFail();
						break;
					case EntityEnum::PAYMENT->value:
						$payment = Payment::where('id', $article_id)->firstOrFail();
						break;
					case EntityEnum::RECEIPT->value:
						$receipt = Receipt::where('id', $article_id)->firstOrFail();
						break;
					default:
						Log::error(tenant('id'). 'tenant.ReportController.run entity = '.$report->entity.' article_id = ' . $article_id);
						return redirect()->back()->with('error', 'Unknown Error!');
				}
			} catch (ModelNotFoundException $exception) {
				//} catch (Exception $e) {
				throw ValidationException::withMessages(['article_id' => $report->entity.' ID #'.$article_id.' not found!']);
			}
		}


		switch ($report->code) {
			case 'pr':
				return self::pr($article_id);
				break;
			case 'prlist':
				return self::prlist($start_date, $end_date, $dept_id);
				break;
			case 'prllist':
				return self::prllist($start_date, $end_date, $dept_id);
				break;

			case 'po':
					return self::po($article_id);
					break;
			case 'polist':
				return self::polist($start_date, $end_date, $dept_id);
				break;
			case 'pollist':
				return self::pollist($start_date, $end_date, $dept_id);
				break;

			case 'invoice':
					return self::invoice($article_id);
					break;
			case 'invoicelist':
				return self::invoicelist($start_date, $end_date, $dept_id);
				break;

			case 'payment':
					return self::payment($article_id);
					break;
			case 'paymentlist':
				return self::paymentlist($start_date, $end_date, $dept_id);
				break;

			case 'receipt':
					return self::receipt($article_id);
					break;
			case 'receiptlist':
					return self::receiptlist($start_date, $end_date, $dept_id);
					break;


			case 'projectspend':
				return self::projectspend($start_date, $end_date, $project_id);
				break;

			case 'supplierspend':
				return self::supplierspend($start_date, $end_date, $supplier_id);
				break;

			case 'taxregister':
				return self::taxregister($start_date, $end_date, $dept_id);
				break;

			case 'aellist':
				return self::aellist($start_date, $end_date);
				break;

			default:
				Log::warning(tenant('id').' tenant.report.run report_id = '.$report->id.' not found!');
		}
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
	public function store(StoreExportRequest $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Export $export)
	{
		$this->authorize('view', $report);

		return view('tenant.exports.show', compact('report'));
    }

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Export $export)
	{
		$this->authorize('update', $report);

		return view('tenant.exports.edit', compact('report'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateExportRequest $request, Export $export)
	{
		$this->authorize('update', $report);

		// check box
		$request->merge(['article_id' => ($request->has('article_id') ? 1 : 0) ]);
		$request->merge(['article_id_required' => ($request->has('article_id_required') ? 1 : 0) ]);

		$request->merge(['start_date' => ($request->has('start_date') ? 1 : 0) ]);
		$request->merge(['start_date_required' => ($request->has('start_date_required') ? 1 : 0) ]);

		$request->merge(['end_date' => ($request->has('end_date') ? 1 : 0) ]);
		$request->merge(['end_date_required' => ($request->has('end_date_required') ? 1 : 0) ]);

		$request->merge(['user_id' => ($request->has('user_id') ? 1 : 0) ]);
		$request->merge(['user_id_required' => ($request->has('user_id_required') ? 1 : 0) ]);

		$request->merge(['item_id' => ($request->has('item_id') ? 1 : 0) ]);
		$request->merge(['item_id_required' => ($request->has('item_id_required') ? 1 : 0) ]);

		$request->merge(['supplier_id' => ($request->has('supplier_id') ? 1 : 0) ]);
		$request->merge(['supplier_id_required' => ($request->has('supplier_id_required') ? 1 : 0) ]);

		$request->merge(['project_id' => ($request->has('project_id') ? 1 : 0) ]);
		$request->merge(['project_id_required' => ($request->has('project_id_required') ? 1 : 0) ]);

		$request->merge(['category_id' => ($request->has('category_id') ? 1 : 0) ]);
		$request->merge(['category_id_required' => ($request->has('category_id_required') ? 1 : 0) ]);

		$request->merge(['dept_id' => ($request->has('dept_id') ? 1 : 0) ]);
		$request->merge(['dept_id_required' => ($request->has('dept_id_required') ? 1 : 0) ]);

		$request->merge(['warehouse_id' => ($request->has('warehouse_id') ? 1 : 0) ]);
		$request->merge(['warehouse_id_required' => ($request->has('warehouse_id_required') ? 1 : 0) ]);

		$report->update($request->all());

		// Write to Log
		EventLog::event('report', $report->id, 'update', 'name', $report->name);

		return redirect()->route('exports.index')->with('success', 'Export updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Export $export)
	{
		//
	}

    public function pr($id)
	{

		$pr 		= Pr::with('requestor')->where('id', $id)->firstOrFail();
		if (! Gate::allows('pr-pdf', $pr)) {
			abort(403);
		}

		$setup 		= Setup::with('country_name')->first();
		$report 	= Export::where('code', __FUNCTION__)->firstOrFail();
		$prls 		= Prl::with('item')->where('pr_id', $pr->id)->get()->all();

		$title 		= $report->name. ' #'. $pr->id; ;
		$subTitle	= 'Amount: '. number_format($pr->amount, 2) .' '. $pr->currency;
		$param1 	= 'Approval: '. strtoupper($pr->auth_status);
		$param2 	= '';
		$param3 	= '';
		self::increaseRunCounter(Str::lower($report->code));

		$data = [
			'setup' 	=> $setup,
			'report' 	=> $report,
			'title' 	=> $title,
			'subTitle' 	=> $subTitle,
			'param1' 	=> $param1,
			'param2' 	=> $param2,
			'param3' 	=> $param3,
			'pr' 		=> $pr,
			'prls' 		=> $prls,
		];

		//PDF::setOptions(['debugCss' => true]);
		$pdf = PDF::loadView('tenant.exports.formats.pr', $data);

		// ->setOption('fontDir', public_path('/fonts/lato'));
		Watermark::set($pdf, $pr->auth_status);

		return $pdf->stream('PR#'.$pr->id.'.pdf');
	}

}
