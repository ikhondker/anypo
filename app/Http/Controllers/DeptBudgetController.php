<?php

namespace App\Http\Controllers;

use App\Models\DeptBudget;
use App\Http\Requests\StoreDeptBudgetRequest;
use App\Http\Requests\UpdateDeptBudgetRequest;

# Models
use App\Models\Budget;
use App\Models\Dept;
use App\Models\Attachment;
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

# Exceptions
# Events


class DeptBudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dept_budgets = DeptBudget::query();
        if (request('term')) {
            $dept_budgets->whereHas('dept', function ($q) {
                $q->where('name', 'LIKE', '%' .request('term'). '%');
            });
        }
        $dept_budgets = $dept_budgets->orderBy('id', 'DESC')->paginate(10);
        return view('dept-budgets.index', compact('dept_budgets'))->with('i', (request()->input('page', 1) - 1) * 10);
    }


    /**
    * Display a listing of the resource.
    */
    public function revision(DeptBudget $deptBudget)
    {
        Log::debug("deptBudget->id=".$deptBudget->id);
        $dept_budgets = DeptBudget::where('budget_id', $deptBudget->budget_id)->where('dept_id', $deptBudget->dept_id)->orderBy('id', 'ASC')->paginate(10);
        return view('dept-budgets.revision', compact('deptBudget', 'dept_budgets'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', DeptBudget::class);

        $budgets = Budget::getAll();
        $depts = Dept::getAll();
        return view('dept-budgets.create', compact('budgets', 'depts'));
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

        return redirect()->route('dept-budgets.index')->with('success', 'DeptBudget created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(DeptBudget $deptBudget)
    {
        //$this->authorize('view', $deptBudget);
        return view('dept-budgets.show', compact('deptBudget'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DeptBudget $deptBudget)
    {
        $this->authorize('update', $deptBudget);

        return view('dept-budgets.edit', compact('deptBudget'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDeptBudgetRequest $request, DeptBudget $deptBudget)
    {
        $this->authorize('update', $deptBudget);

        // check if budget exists and nt freezed. should exists
        $budget = Budget::where('id', $deptBudget->budget_id)->first();
        if ($budget->freeze) {
            return redirect()->route('budgets.index')->with('error', 'Budget is freezed. Your admin need to unfreeze it, before update!');
        }

        $request->validate([

        ]);

        // create revision row
        //Log::debug("Input=".$request->input('amount'));
        //Log::debug("amount=".$deptBudget->amount);

        // budget has been modified
        if ($request->input('amount') <> $deptBudget->amount) {
            //update main budget
            $budget->amount = $budget->amount - $deptBudget->amount + $request->input('amount');
            $budget->save();
            EventLog::event('deptBudget', $deptBudget->id, 'update', 'amount', $deptBudget->amount);
        }

        //dd($deptBudget);
        $deptBudget->update($request->all());

        return redirect()->route('dept-budgets.index')->with('success', 'DeptBudget updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeptBudget $deptBudget)
    {
        $this->authorize('delete', $deptBudget);

        $deptBudget->fill(['freeze' => !$deptBudget->freeze]);
        $deptBudget->update();

        // Write to Log
        EventLog::event('deptBudget', $deptBudget->id, 'status', 'freeze', $deptBudget->freeze);

        return redirect()->route('dept-budgets.index')->with('success', 'DeptBudget status Updated successfully');
    }

    public function export()
    {
        $this->authorize('export', Budget::class);
        $data = DB::select("SELECT db.id, b.name budget_name, d.name dept_name, db.amount, db.amount_pr_booked, db.amount_pr_issued, db.amount_po_booked, db.amount_po_issued, db.amount_grs, db.amount_payment, 
        db.notes, IF(db.enable, 'Yes', 'No') as Enable
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
        //$this->authorize('create', DeptBudget::class);

        if ($file = $request->file('file_to_upload')) {
            $request->merge(['article_id'    => $request->input('attach_dept_budget_id') ]);
            $request->merge(['entity'       => EntityEnum::DEPTBUDGET->value  ]);
            $attid = FileUpload::upload($request);
            //$request->merge(['logo'       => $fileName ]);
        }

        return redirect()->route('dept-budgets.show', $request->input('attach_dept_budget_id'))->with('success', 'File Uploaded successfully.');
    }

    public function detach(DeptBudget $deptBudget)
    {
        //$this->authorize('view', $pr);

        $deptBudget = DeptBudget::where('id', $deptBudget->id)->get()->firstOrFail();
        $attachments = Attachment::where('entity', EntityEnum::DEPTBUDGET->value)->where('article_id', $deptBudget->id)->get()->all();
        return view('dept-budgets.detach', compact('deptBudget', 'attachments'));
    }

}
