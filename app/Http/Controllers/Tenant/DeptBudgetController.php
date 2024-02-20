<?php

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;

use App\Models\Tenant\DeptBudget;
use App\Http\Requests\Tenant\StoreDeptBudgetRequest;
use App\Http\Requests\Tenant\UpdateDeptBudgetRequest;

# Models
use App\Models\Tenant\Budget;
use App\Models\Tenant\Lookup\Dept;
use App\Models\Tenant\Admin\Attachment;
# Enums
use App\Enum\EntityEnum;
# Helpers
use App\Helpers\EventLog;
use App\Helpers\Export;
use App\Helpers\FileUpload;
# Notifications
# Mails
# Packages
# Seeded
use DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Http\FormRequest;

use App\Jobs\Tenant\ConsolidateBudget;

# Exceptions
# Events
# TODO
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

		$dept_budgets = $dept_budgets->with('dept')->with('budget')->orderBy('id', 'DESC')->paginate(10);
		return view('tenant.dept-budgets.index', compact('dept_budgets'));
	}


	/**
	* Display a listing of the resource.
	*/
	public function xxrevision(DeptBudget $deptBudget)
	{
		$dept_budgets = DeptBudget::where('budget_id', $deptBudget->budget_id)->where('dept_id', $deptBudget->dept_id)->orderBy('id', 'ASC')->paginate(10);
		return view('tenant.dept-budgets.revision', compact('deptBudget', 'dept_budgets'));
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

		$dept_budget = DeptBudget::create($request->all());
		// Write to Log
		EventLog::event('deptBudget', $dept_budget->id, 'create');

		//update company budget for that year
		ConsolidateBudget::dispatch($dept_budget->budget_id);

		return redirect()->route('tenant.dept-budgets.index')->with('success', 'DeptBudget created successfully.');
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
	 * Show the form for editing the specified resource.
	 */
	public function edit(DeptBudget $deptBudget)
	{
		$this->authorize('update', $deptBudget);

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

		
		// upload file as record
		if ($file = $request->file('file_to_upload')) {
			$request->merge(['article_id'	=> $deptBudget->id ]);
			$request->merge(['entity'		=> EntityEnum::DEPTBUDGET->value ]);
			$attid = FileUpload::upload($request);
		}

		// budget has been modified
		$old_dept_budget_amount =$deptBudget->amount;
		$deptBudget->update($request->all());

		if ($request->input('amount') <> $old_dept_budget_amount) {
			//update company budget for that year
			ConsolidateBudget::dispatch($deptBudget->budget_id);

			//$result = Budget::updateCompanyBudget($deptBudget->budget_id);
			EventLog::event('deptBudget', $deptBudget->id, 'update', 'amount', $deptBudget->amount);
		}

		return redirect()->route('dept-budgets.show',$deptBudget->id )->with('success', 'DeptBudget updated successfully');
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

		return redirect()->route('dept-budgets.index')->with('success', 'DeptBudget status Updated successfully');
	}

	public function export()
	{
		$this->authorize('export', DeptBudget::class);
		$data = DB::select("SELECT db.id, b.name budget_name, d.name dept_name, db.amount, db.amount_pr_booked, db.amount_pr_issued, db.amount_po_booked, db.amount_po_issued, db.amount_grs, db.amount_payment, 
		db.notes, 	IF(db.closed, 'Yes', 'No') as Closed
		FROM dept_budgets db,budgets b,depts d
		WHERE db.budget_id = b.id
		AND db.dept_id=d.id");
		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('dept_budgets', $dataArray);
	}


	// add attachments
	public function attach(FormRequest $request)
	{
		$this->authorize('create', DeptBudget::class);

		if ($file = $request->file('file_to_upload')) {
			$request->merge(['article_id'	=> $request->input('attach_dept_budget_id') ]);
			$request->merge(['entity'		=> EntityEnum::DEPTBUDGET->value ]);
			$attid = FileUpload::upload($request);
			//$request->merge(['logo'=> $fileName ]);
		}

		return redirect()->route('dept-budgets.show', $request->input('attach_dept_budget_id'))->with('success', 'File Uploaded successfully.');
	}

	public function detach(DeptBudget $deptBudget)
	{
		$this->authorize('view', $pr);

		$deptBudget = DeptBudget::where('id', $deptBudget->id)->get()->firstOrFail();
		$attachments = Attachment::with('owner')->where('entity', EntityEnum::DEPTBUDGET->value)->where('article_id', $deptBudget->id)->get()->all();
		return view('tenant.dept-budgets.detach', compact('deptBudget', 'attachments'));
	}

	/**
	 * Display the specified resource.
	 */
	public function budget(DeptBudget $deptBudget)
	{
		$this->authorize('view', $deptBudget);

		return view('tenant.dept-budgets.budget', compact('deptBudget'));
	}

}
