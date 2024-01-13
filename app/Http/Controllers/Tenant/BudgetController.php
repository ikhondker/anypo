<?php

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;

use App\Models\Tenant\Budget;
use App\Http\Requests\Tenant\StoreBudgetRequest;
use App\Http\Requests\Tenant\UpdateBudgetRequest;

# Models
use App\Models\Tenant\Admin\Setup;
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
use Carbon\Carbon;
use DB;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

# Exceptions
# Events

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
		$budgets = $budgets->orderBy('id', 'DESC')->paginate(10);

		return view('tenant.budgets.index', compact('budgets'))->with('i', (request()->input('page', 1) - 1) * 10);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{

		$this->authorize('create', Budget::class);

		$setup = Setup::first();

		$lastbudget = Budget::latest()->first();
		$lastbudget = Budget::orderBy('fy', 'desc')->first();

		$fy = (int) $lastbudget->fy;
		$fy = $fy + 1 ;

		$budget = new Budget();
		$budget->fy			= (string) $fy;
		$budget->name		= 'Budget for ' .$budget->fy;
		$budget->start_date	= Carbon::parse($budget->fy.'-01-01');
		$budget->end_date	= Carbon::parse($budget->fy.'-12-31');
		$budget->notes		= 'Budget for ' .$budget->fy;
		;
		$budget->freeze	= false;
		$budget->save();
		$budget_id = $budget->id;


		// insert deptbudget rows
		DB::INSERT("INSERT INTO dept_budgets(budget_id, dept_id) 
				SELECT ".$budget_id.",id 
				FROM depts WHERE enable = 1 ;");

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
		$budget->update($request->all());


		// upload file as record
		if ($file = $request->file('file_to_upload')) {
			$request->merge(['article_id'	=> $budget->id ]);
			$request->merge(['entity'		=> EntityEnum::BUDGET->value ]);
			$attid = FileUpload::upload($request);
		}

		// Write to Log
		EventLog::event('budget', $budget->id, 'update', 'name', $budget->name);

		return redirect()->route('budgets.show',$budget->id )->with('success', 'Budget updated successfully');

	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Budget $budget)
	{
		$this->authorize('delete', $budget);

		$budget->fill(['freeze' => ! $budget->freeze]);
		$budget->update();

		// Write to Log
		EventLog::event('budget', $budget->id, 'status', 'freeze', $budget->freeze);

		return redirect()->route('budgets.index')->with('success', 'Budget status Updated successfully');
	}

	public function export()
	{
		$this->authorize('export', Budget::class);
		$data = DB::select("SELECT id, fy, name, start_date, end_date, amount, amount_pr_booked, amount_pr_issued, amount_po_booked, amount_po_issued, amount_grs, amount_payment, notes, 
				IF(freeze, 'Yes', 'No') as Freeze
			FROM budgets");
		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('budgets', $dataArray);
	}

	// add attachments
	public function attach(FormRequest $request)
	{
		//$this->authorize('create', Budget::class);

		if ($file = $request->file('file_to_upload')) {
			$request->merge(['article_id'	=> $request->input('attach_budget_id') ]);
			$request->merge(['entity'		=> EntityEnum::BUDGET->value ]);
			$attid = FileUpload::upload($request);
		}
		return redirect()->route('budgets.show', $request->input('attach_budget_id'))->with('success', 'File Uploaded successfully.');
	}

	public function detach(Budget $budget)
	{
		//$this->authorize('view', $pr);

		$budget = Budget::where('id', $budget->id)->get()->firstOrFail();
		$attachments = Attachment::where('entity', EntityEnum::BUDGET->value)->where('article_id', $budget->id)->get()->all();
		return view('tenant.budgets.detach', compact('budget', 'attachments'));
	}

}
