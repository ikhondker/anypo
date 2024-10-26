<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			BudgetController.php
* @brief		This file contains the implementation of the BudgetController
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

use App\Models\Tenant\Budget;
use App\Http\Requests\Tenant\StoreBudgetRequest;
use App\Http\Requests\Tenant\UpdateBudgetRequest;


# 1. Models
use App\Models\Tenant\Admin\Setup;
use App\Models\Tenant\Attachment;

# 2. Enums
use App\Enum\Tenant\EntityEnum;
# 3. Helpers
use App\Helpers\Tenant\FileUpload;
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
use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;
use Exception;
# 13. FUTURE

class BudgetController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->authorize('viewAny', Budget::class);

		$budgets = Budget::query();
		if (request('term')) {
			$budgets->where('name', 'Like', '%'.request('term').'%');
		}
		$budgets = $budgets->where('revision',false)->orderBy('id', 'DESC')->paginate(10);

		return view('tenant.budgets.index', compact('budgets'));
	}

    /**
	 * Display a listing of the resource.
	 */
	public function revisionsAll()
	{
		$this->authorize('viewAny', Budget::class);

		$budgets = Budget::query();
		if (request('term')) {
			$budgets->where('name', 'Like', '%'.request('term').'%');
		}
		$budgets = $budgets->where('revision',true)->orderBy('id', 'DESC')->paginate(10);
		return view('tenant.budgets.revisions-all', compact('budgets'));
	}


	/**
	 * Display a listing of the resource.
	 */
	public function revisions(Budget $budget)
	{
		$this->authorize('viewAny', Budget::class);

		$budgets = Budget::where('parent_id',$budget->id)
					->where('revision',true)
				 	->orderBy('id', 'DESC')->paginate(10);
		return view('tenant.budgets.revisions', compact('budgets','budget'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{

		$this->authorize('create', Budget::class);

		// Make sure only one budget is open at a time
		$count_open	= Budget::where('closed', false)->where('revision',false)->count();
		if ($count_open <> 0){
			return redirect()->route('budgets.index')->with('error', 'Please close previous Years budget, before opening new Budget year.');
		}

		$setup = Setup::first();
		$lastbudget = Budget::where('revision',false)->orderBy('fy', 'desc')->first();

		$fy = (int) $lastbudget->fy;
		$fy = $fy + 1 ;

		$budget = new Budget();
		$budget->fy			= (string) $fy;
		$budget->name		= 'Budget for ' .$budget->fy;
		$budget->start_date	= Carbon::parse($budget->fy.'-01-01');
		$budget->end_date	= Carbon::parse($budget->fy.'-12-31');
		$budget->notes		= 'Budget for ' .$budget->fy;

		$budget->closed	= false;
		$budget->save();
		$budget_id = $budget->id;

		// insert deptbudget rows
		DB::INSERT("INSERT INTO
					dept_budgets(budget_id, dept_id)
				SELECT ".
					$budget_id.",id
				FROM depts
				WHERE enable = 1 ;");

		return redirect()->route('budgets.index')->with('success', 'Next Year Budget opened successfully');

	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreBudgetRequest $request)
	{

		abort(403);
		$this->authorize('create', Budget::class);
		$budget = Budget::create($request->all());
		// Write to Log
		EventLog::event('budget', $budget->id, 'create');
		return redirect()->route('budgets.index')->with('success', 'Budget created successfully.');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Budget $budget)
	{
		//$this->authorize('view', $budget);

		return view('tenant.budgets.show', compact('budget'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Budget $budget)
	{
		$this->authorize('update', $budget);

		if ($budget->closed){
			return redirect()->route('budgets.show', $budget->id)->with('error', 'Can not edit a closed Budget.');
		}

		return view('tenant.budgets.edit', compact('budget'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateBudgetRequest $request, Budget $budget)
	{
		$this->authorize('update', $budget);

		//$request->validate();
		$request->validate([

		]);

		// Write to Log
		EventLog::event('budget', $budget->id, 'update', 'name', $budget->name);
		$budget->update($request->all());

		// upload file as record
		if ($file = $request->file('file_to_upload')) {
			$request->merge(['article_id'	=> $budget->id ]);
			$request->merge(['entity'		=> EntityEnum::BUDGET->value ]);
			$attid = FileUpload::aws($request);
		}



		return redirect()->route('budgets.show',$budget->id )->with('success', 'Budget updated successfully');

	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Budget $budget)
	{
		$this->authorize('delete', $budget);

		// while opening a budget , ake sure only one budget is open at a time
		if ($budget->closed){ // user is trying to open a budget
			$count_open	= Budget::where('closed', false)->where('revision',false)->count();
			if ($count_open <> 0){
				return redirect()->route('budgets.index')->with('error', 'Please close the open budget, before opening new budget.');
			}
		}
		$budget->fill(['closed' => ! $budget->closed]);
		$budget->update();

		// Write to Log
		EventLog::event('budget', $budget->id, 'status', 'closed', $budget->closed);

		return redirect()->route('budgets.index')->with('success', 'Budget status Updated successfully');
	}

	public function export()
	{
		$this->authorize('export', Budget::class);
		$sql = "
			SELECT b.id, b.fy, b.name, b.start_date, b.end_date,
			b.amount,
			b.amount_pr_booked, b.amount_pr,
			b.amount_po_booked, b.amount_po,
			b.amount_grs, b.amount_invoice, b.amount_payment, b.notes,
			IF(b.closed, 'Yes', 'No') as closed
			FROM budgets b
			WHERE b.revision = false
			";

		//Log::debug(tenant('id'). 'tenant.Budget.export sql = '. $sql);
		$data = DB::select($sql);

		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('budgets', $dataArray);
	}

	// add attachments
	public function attach(FormRequest $request)
	{

		$this->authorize('create', Budget::class);

		// allow add attachment only if budget is open
		try {
			$budget = Budget::where('id', $request->input('attach_budget_id'))->get()->firstOrFail();
		} catch (Exception $e) {
			Log::error(tenant('id'). ' tenant.budget.attach user_id = '. auth()->user()->id.' request = '. $request. ' class = '.get_class($e). ' Message = '. $e->getMessage());
			return redirect()->back()->with(['error' => 'Budget not Found!']);
		}

		if ($budget->closed){
			return redirect()->route('budgets.show', $budget->id)->with('error', 'Add attachment is allowed only for open Budget.');
		}

		if ($file = $request->file('file_to_upload')) {
			$request->merge(['article_id'	=> $request->input('attach_budget_id') ]);
			$request->merge(['entity'		=> EntityEnum::BUDGET->value ]);
			$attid = FileUpload::aws($request);
		}
		return redirect()->route('budgets.show', $request->input('attach_budget_id'))->with('success', 'File Uploaded successfully.');
	}

	public function attachments(Budget $budget)
	{
		$this->authorize('view', $budget);

		$budget = Budget::where('id', $budget->id)->get()->firstOrFail();
		//$attachments = Attachment::where('entity', EntityEnum::BUDGET->value)->where('article_id', $budget->id)->get()->all();
		return view('tenant.budgets.attachments', compact('budget'));
	}

}
