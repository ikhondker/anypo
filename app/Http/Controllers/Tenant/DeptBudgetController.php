<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			DeptBudgetController.php
* @brief		This file contains the implementation of the DeptBudgetController
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

use App\Models\Tenant\DeptBudget;
use App\Http\Requests\Tenant\StoreDeptBudgetRequest;
use App\Http\Requests\Tenant\UpdateDeptBudgetRequest;

# 1. Models
use App\Models\Tenant\Budget;
use App\Models\Tenant\Lookup\Dept;
use App\Models\Tenant\Attachment;
# 2. Enums
use App\Enum\EntityEnum;
use App\Enum\UserRoleEnum;
use App\Helpers\Tenant\FileUpload;
# 3. Helpers
use App\Helpers\Export;
use App\Helpers\EventLog;
# 4. Notifications
# 5. Jobs
use App\Jobs\Tenant\ConsolidateBudget;
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
use Exception;
# 13. FUTURE
#1. Create and save revision history


class DeptBudgetController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->authorize('viewAny', DeptBudget::class);

		$dept_budgets = DeptBudget::query();
		if (request('term')) {
			$dept_budgets->whereHas('dept', function ($q) {
				$q->where('name', 'LIKE', '%' .request('term'). '%');
			});
		}

		switch (auth()->user()->role->value) {
			case UserRoleEnum::HOD->value:
				$dept_budgets = $dept_budgets->ByDeptAll()->with('dept')->with('budget')->where('revision',false)->orderBy('budget_id', 'DESC')->paginate(10);
				break;
			case UserRoleEnum::BUYER->value:
			case UserRoleEnum::CXO->value:
			case UserRoleEnum::ADMIN->value:
			case UserRoleEnum::SYSTEM->value:
				$dept_budgets = $dept_budgets->with('dept')->with('budget')->where('revision',false)->orderBy('budget_id', 'DESC')->paginate(10);
				break;
			default:
				//$dept_budgets = $dept_budgets->ByUserAll()->with('dept')->with('budget')->paginate(10);
				Log::warning(tenant('id'). 'tenant.DeptBudget.index Other role = '. auth()->user()->role->value);
				abort(403);
		}

		//$dept_budgets = $dept_budgets->with('dept')->with('budget')->orderBy('id', 'DESC')->paginate(10);
		return view('tenant.dept-budgets.index', compact('dept_budgets'));
	}


	/**
	 * Display a listing of the resource.
	 */
	public function revisions(DeptBudget $deptBudget)
	{
		$this->authorize('viewAny', DeptBudget::class);
		// TODO restrict direct access

		$deptBudgets = DeptBudget::where('parent_id',$deptBudget->id)
					->where('revision',true)
				 	->orderBy('id', 'DESC')->paginate(10);

		return view('tenant.dept-budgets.revisions', compact('deptBudgets','deptBudget'));
	}

	/**
	 * Display a listing of the resource.
	 */
	public function revisionsAll()
	{
		$this->authorize('viewAny', DeptBudget::class);

		$deptBudgets = DeptBudget::query();
		if (request('term')) {
			$deptBudgets->whereHas('dept', function ($q) {
				$q->where('name', 'LIKE', '%' .request('term'). '%');
			});
		}

		switch (auth()->user()->role->value) {
			case UserRoleEnum::HOD->value:
				$deptBudgets = $deptBudgets->ByDeptAllRevisions()->with('dept')->with('budget')->orderBy('budget_id', 'DESC')->paginate(10);
				break;
			case UserRoleEnum::BUYER->value:
			case UserRoleEnum::CXO->value:
			case UserRoleEnum::ADMIN->value:
			case UserRoleEnum::SYSTEM->value:
				$deptBudgets = $deptBudgets->with('dept')->with('budget')->where('revision',true)->orderBy('budget_id', 'DESC')->paginate(10);
				break;
			default:
				//$dept_budgets = $dept_budgets->ByUserAll()->with('dept')->with('budget')->paginate(10);
				Log::warning(tenant('id'). 'tenant.DeptBudget.index Other role = '. auth()->user()->role->value);
				abort(403);
		}

		//$dept_budgets = $dept_budgets->with('dept')->with('budget')->orderBy('id', 'DESC')->paginate(10);
		return view('tenant.dept-budgets.revisions-all', compact('deptBudgets'));
	}


	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$this->authorize('create', DeptBudget::class);

		$budgets = Budget::primary()->get();
		$depts = Dept::primary()->get();
		return view('tenant.dept-budgets.create', compact('budgets', 'depts'));
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreDeptBudgetRequest $request)
	{
		$this->authorize('create', DeptBudget::class);

		// Make sure only one budget is open at a time
		$count_dept_budget	= DeptBudget::where('budget_id', $request['budget_id'])
					->where('dept_id', $request['dept_id'])
					->where('revision',false)
					->count();
		if ($count_dept_budget <> 0){
			return redirect()->route('dept-budgets.index')->with('error', 'Dept Budget for this period already exists!');
		}

		// old check
		// $validatedData = $request->validate([
		// 'budget_id' => 'required|unique:dept_budgets,dept_id',
		// 'dept_id' 	=> 'required|unique:dept_budgets,budget_id',
		// ]);

		$dept_budget = DeptBudget::create($request->all());
		// Write to Log
		EventLog::event('deptBudget', $dept_budget->id, 'create');

		//update company budget for that year
		ConsolidateBudget::dispatch($dept_budget->budget_id);

		return redirect()->route('dept-budgets.index')->with('success', 'Dept Budget created successfully.');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(DeptBudget $deptBudget)
	{
		$this->authorize('view', $deptBudget);

		return view('tenant.dept-budgets.show', compact('deptBudget'));
	}


	/**
	 * Display the specified resource.
	 */
	public function showRevision(DeptBudget $deptBudget)
	{
		$this->authorize('view', $deptBudget);

		return view('tenant.dept-budgets.show-revision', compact('deptBudget'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(DeptBudget $deptBudget)
	{
		$this->authorize('update', $deptBudget);


		if ($deptBudget->budget->closed){
			return redirect()->route('budgets.index')->with('error', 'Can not edit a Dept Budget, as company budget for this year is closed.');
		}

		if ($deptBudget->closed){
			return redirect()->route('dept-budgets.index')->with('error', 'Can not edit a closed Dept Budget.');
		}

		return view('tenant.dept-budgets.edit', compact('deptBudget'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateDeptBudgetRequest $request, DeptBudget $deptBudget)
	{
		$this->authorize('update', $deptBudget);

		// check if budget exists and nt freezed. should exists
		$budget = Budget::where('id', $deptBudget->budget_id)->first();
		if ($budget->closed) {
			return redirect()->route('budgets.index')->with('error', 'Budget '.$budget->name.'is closed. Your admin need to unfreeze it, before update!');
		}

		// Check if enter amount is below already isseud + Booked amount
		if ( $request->input('amount') < $deptBudget->amount_pr_booked + $deptBudget->amount_pr)	{
			return redirect()->route('dept-budgets.edit', $deptBudget->id)->with('error', 'Unable to reduce Dept Budget below already Booked and Issued PR amount!');
		}

		if ( $request->input('amount') < $deptBudget->amount_po_booked + $deptBudget->amount_po)	{
			return redirect()->route('dept-budgets.edit', $deptBudget->id)->with('error', 'Unable to reduce Dept Budget below already Booked and Issued PO amount!');
		}


		// upload file as record
		if ($file = $request->file('file_to_upload')) {
			$request->merge(['article_id'	=> $deptBudget->id ]);
			$request->merge(['entity'		=> EntityEnum::DEPTBUDGET->value ]);
			$attid = FileUpload::aws($request);
		}

		// budget has been modified
		$old_dept_budget_amount =$deptBudget->amount;

		// 1. create revision row for dep_budget
		Log::debug(tenant('id'). 'tenant.DeptBudget.update creating revision row for dept_budgets_id = '.$deptBudget->id);
		$sql= "INSERT INTO dept_budgets(
			budget_id, dept_id, amount, amount_pr_booked, amount_pr, amount_po_booked, amount_po, amount_grs, amount_invoice, amount_payment,
			count_pr_booked, count_pr, count_po_booked, count_po, count_grs, count_invoice, count_payment, notes,
			closed, revision, parent_id)
		SELECT
			budget_id, dept_id, amount, amount_pr_booked, amount_pr, amount_po_booked, amount_po, amount_grs, amount_invoice, amount_payment,
			count_pr_booked, count_pr, count_po_booked, count_po, count_grs, count_invoice, count_payment, notes,
			true, true, ".$deptBudget->id."
		FROM dept_budgets
		WHERE id= ".$deptBudget->id." ;";
		//Log::warning(tenant('id'). 'tenant.DeptBudget.update dept_budgets sql = '. $sql);
		//TODO
		$revision_dept_budget_id = DB::INSERT($sql);
		Log::warning(tenant('id'). 'tenant.DeptBudget.update revision_dept_budget_id = '. $revision_dept_budget_id);

		// 2. create revision for budget
		Log::debug(tenant('id'). 'tenant.DeptBudget.update creating revision row for budgets_id = '.$deptBudget->budget_id);
		$sql= "INSERT INTO budgets(
			fy, name, start_date, end_date, amount,
			amount_pr_booked, amount_pr, amount_po_booked, amount_po, amount_grs, amount_invoice, amount_payment,
			count_pr_booked, count_pr, count_po_booked, count_po, count_grs, count_invoice, count_payment, notes,
			closed, revision, parent_id
			)
		SELECT
			fy, name, start_date, end_date, amount,
			amount_pr_booked, amount_pr, amount_po_booked, amount_po, amount_grs, amount_invoice, amount_payment,
			count_pr_booked, count_pr, count_po_booked, count_po, count_grs, count_invoice, count_payment, notes,
			true, true, ".$deptBudget->budget_id."
		FROM budgets
		WHERE id= ".$deptBudget->budget_id." ;";
		//Log::warning(tenant('id'). 'tenant.DeptBudget.update budgets sql = '. $sql);
		DB::INSERT($sql);

		if ($request->input('amount') <> $old_dept_budget_amount) {
			EventLog::event('deptBudget', $deptBudget->id, 'update', 'amount', $deptBudget->amount);
		}

		// update dept_budget row
		$deptBudget->update($request->all());

		if ($request->input('amount') <> $old_dept_budget_amount) {
			//update company budget for that year
			ConsolidateBudget::dispatch($deptBudget->budget_id);
		}

		return redirect()->route('dept-budgets.show',$deptBudget->id)->with('success', 'DeptBudget updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(DeptBudget $deptBudget)
	{
		$this->authorize('delete', $deptBudget);

		$deptBudget->fill(['closed' => !$deptBudget->closed]);
		$deptBudget->update();

		// Write to Log
		EventLog::event('deptBudget', $deptBudget->id, 'status', 'closed', $deptBudget->closed);

		return redirect()->route('dept-budgets.show',$deptBudget->id)->with('success', 'DeptBudget status Updated successfully');
	}

	public function export()
	{
		$this->authorize('export', DeptBudget::class);

		if (auth()->user()->role->value == UserRoleEnum::HOD->value){
			//$dept_id 	= auth()->user()->dept_id;
			$whereDept = 'db.dept_id = '. auth()->user()->dept_id;
		} else {
			$whereDept = '1 = 1';
		}

		// TODO filter by Hod
		$sql = "
			SELECT db.id, b.name budget_name, d.name dept_name, db.amount, db.amount_pr_booked, db.amount_pr, db.amount_po_booked, db.amount_po, db.amount_grs, db.amount_payment,
			db.notes, IF(db.closed, 'Yes', 'No') as Closed
			FROM dept_budgets db, budgets b, depts d
			WHERE db.budget_id = b.id
			AND db.dept_id=d.id
			AND ". $whereDept ."
			AND db.revision = false
			ORDER BY db.id DESC
		";

		//Log::debug(tenant('id'). 'tenant.DeptBudget.export sql = '. $sql);
		$data = DB::select($sql);

		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('dept_budgets', $dataArray);
	}


	// add attachments
	public function attach(FormRequest $request)
	{

		$this->authorize('create', DeptBudget::class);
		// allow add attachment only if budget is open
		try {
			$deptBudget = DeptBudget::where('id', $request->input('attach_dept_budget_id'))->get()->firstOrFail();
		} catch (Exception $e) {
			Log::error(tenant('id'). ' tenant.dept-budget.attach user_id = '. auth()->user()->id.' request = '. $request. ' class = '.get_class($e). ' Message = '. $e->getMessage());
			return redirect()->back()->with(['error' => 'Dept Budget not Found!']);
		}

		if ($deptBudget->closed){
			return redirect()->route('dept-budgets.show', $deptBudget->id)->with('error', 'Add attachment is only allowed for open Budget.');
		}

		if ($file = $request->file('file_to_upload')) {
			$request->merge(['article_id'	=> $request->input('attach_dept_budget_id') ]);
			$request->merge(['entity'		=> EntityEnum::DEPTBUDGET->value ]);
			$attid = FileUpload::aws($request);
		}

		return redirect()->route('dept-budgets.show', $deptBudget->id)->with('success', 'File Uploaded successfully.');
	}

	public function attachments(DeptBudget $deptBudget)
	{
		$this->authorize('view', $deptBudget);

		$deptBudget = DeptBudget::where('id', $deptBudget->id)->get()->firstOrFail();
		//$attachments = Attachment::with('owner')->where('entity', EntityEnum::DEPTBUDGET->value)->where('article_id', $deptBudget->id)->get()->all();
		return view('tenant.dept-budgets.attachments', compact('deptBudget'));
	}

	/**
	 * Display the specified resource.
	 */
	public function dbu(DeptBudget $deptBudget)
	{
		$this->authorize('view', $deptBudget);

		return view('tenant.dept-budgets.dbu', compact('deptBudget'));
	}

}
