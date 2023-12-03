<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


# Models
//use App\Models\Setup;
use App\Models\Tenant\Admin\Setup;
use App\Models\User;
use App\Models\DeptBudget;

# Enums
# Helpers
# Notifications
# Mails
#Jobs
use App\Jobs\ImportAllRate;
# Packages
# Seeded
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
# Exceptions
# Events
use Illuminate\Support\Collection;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // if new month starts, import rates
        // =================================================
        $setup = Setup::first();
        // check if current months import rates imported
        if ($setup->last_rate_date <> '') {
            $last_rate_month    	= $setup->last_rate_date->startOfMonth();
        } else {
            $last_rate_month    	= '';
        }
        $current_rate_month    	= Carbon::now()->startOfMonth();

        if ($last_rate_month <> $current_rate_month) {
            // import current rates using queue
            ImportAllRate::dispatch();
            Log::debug("Rates Importing for ".$current_rate_month);
        }

        // ====================== Budget====================================
        $records = DB::select("SELECT amount-amount_po_booked-amount_po_issued as amount, amount_po_booked, amount_po_issued
        FROM budgets b
        WHERE b.fy = date('Y')");
        //$result = $dept_budgets->toArray();
        //$data = [];
        $budget_labels = [];
        $budget_labels[] = "Available";
        $budget_labels[] = "PO Booked";
        $budget_labels[] = "PO Issued";

        $budget_data = [];
        foreach($records as $row) {
            $budget_data[] = (int) $row->amount;
            $budget_data[] = (int) $row->amount_po_booked;
            $budget_data[] = (int) $row->amount_po_issued;
        }

        // Generate random colours for the groups
        for ($i = 0; $i <= count($records); $i++) {
            $budget_colors[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
        }

        // ====================== Dept Allocated Budget====================================
        $records = DB::select("SELECT d.name, db.amount
            FROM dept_budgets db, budgets b, depts d
            WHERE db.budget_id=b.id
            and b.fy = date('Y')
            and db.dept_id=d.id");
        $depb_labels = [];
        $depb_data = [];
        foreach($records as $row) {
            $depb_labels[] = $row->name;
            $depb_data[] = (int) $row->amount;
        }
        // Generate random colours for the groups
        for ($i = 0; $i <= count($records); $i++) {
            $depb_colors[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
        }


        // ====================== Dept Allocated vs used Budget====================================
        $records = DB::select("SELECT d.name, db.amount, db.amount_po_issued
        FROM dept_budgets db, budgets b, depts d
        WHERE db.budget_id=b.id
        and b.fy = date('Y')
        and db.dept_id=d.id");
        $depb_budget_labels = [];
        $depb_budget_amount = [];
        $depb_budget_po_issued = [];
        $depb_budget_colors = [];

        foreach($records as $row) {
            $depb_budget_labels[] = $row->name;
            $depb_budget_amount[] = (int) $row->amount;
            $depb_budget_po_issued[] = (int) $row->amount_po_issued;

        }
        // Generate random colours for the groups
        for ($i = 0; $i <= count($records); $i++) {
            $depb_budget_colors[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
        }
        //dd($depb_budget_labels,$depb_budget_amount,$depb_budget_po_issued);


        // ====================== View ====================================
        return view('tenant.dashboards.index', compact(
            'budget_labels',
            'budget_data',
            'budget_colors',
            'depb_labels',
            'depb_data',
            'depb_colors',
            'depb_budget_labels',
            'depb_budget_amount',
            'depb_budget_po_issued',
            'depb_budget_colors'
        ));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
