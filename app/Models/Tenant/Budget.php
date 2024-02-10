<?php

namespace App\Models\Tenant;

/* IQBAL 21-OCT-22 */
use App\Traits\AddCreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Support\Facades\Log;

//use App\Models\User;
//use App\Models\DeptBudget;

use DB;

class Budget extends Model
{
	use HasFactory;
	use AddCreatedUpdatedBy;

	protected $fillable = [
		'fy', 'name', 'start_date', 'end_date', 'amount', 'amount_pr_booked', 'amount_pr_issued', 'amount_po_booked', 'amount_po_issued', 'amount_grs', 'amount_invoice', 'amount_payment', 'notes', 'text_color', 'bg_color', 'icon', 'closed', 'updated_by', 'updated_at',
	];

	/* ----------------- Scopes ------------------------- */
	/**
	 * Scope a query to only include current account users.
	 */
	public function scopePrimary(Builder $query): void
	{
		$query->where('closed', false);
	} 

	/**
	 * Scope a query to only All PR for current user dept.
	*/
	public function scopeByFy(Builder $query): void
	{
		$query->where('fy',  date('Y'));
	}


	/* ----------------- Functions ---------------------- */
	public static function tbdgetAll()
	{
		return Budget::select('id', 'name')
			->where('freeze', false)
			->orderBy('id', 'asc')
			->get();
	}

	// populate Company Budget 
	public static function xxxxupdateCompanyBudget($budget_id)
	{

		$budget = Budget::where('id', $budget_id)->firstOrFail();
		
		Log::debug('Value of dept_budget_id=' . $dept_budget_id);
		$result= DeptBudget::where('budget_id', $budget->id)->get( array(
			DB::raw('SUM(amount) as amount'),
			DB::raw('SUM(amount_pr_booked) as amount_pr_booked'),
			DB::raw('SUM(amount_pr_issued) as amount_pr_issued'),
			DB::raw('SUM(amount_po_booked) as amount_po_booked'),
			DB::raw('SUM(amount_po_issued) as amount_po_issued'),
			DB::raw('SUM(amount_grs) as amount_grs'),
			DB::raw('SUM(amount_payment) as amount_payment'),
		));
		
		foreach($result as $row) {
			$budget->amount				= $row['amount'] ;
			$budget->amount_pr_booked	= $row['amount_pr_booked'] ;
			$budget->amount_pr_issued	= $row['amount_pr_issued'] ;
			$budget->amount_po_booked	= $row['amount_po_booked'];
			$budget->amount_po_issued	= $row['amount_po_issued'];
			$budget->amount_grs			= $row['amount_grs'];
			$budget->amount_payment		= $row['amount_payment'];
		}
	
		$budget->save();

		return true;
	}

	/* ----------------- HasMany ------------------------ */
	public function deptBudgets(): HasMany
	{
		return $this->hasMany(DeptBudget::class, 'budget_id');
	}
}
