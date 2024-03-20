<?php

namespace App\Models\Tenant;


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
		'budget_id', 'dept_id', 'amount', 'amount_pr_booked', 'amount_pr', 'amount_po_booked', 'amount_po', 'amount_grs', 'amount_invoice', 'amount_payment', 'count_pr_booked', 'count_pr', 'count_po_booked', 'count_po', 'count_grs', 'count_invoice', 'count_payment', 'end_date', 'notes', 'closed', 'updated_by', 'updated_at',


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
	public function chkscopeByFy(Builder $query): void
	{
		$query->where('fy',  date('Y'));
	}


	/* ----------------- Functions ---------------------- */

	/* ----------------- HasMany ------------------------ */
	public function deptBudgets(): HasMany
	{
		return $this->hasMany(DeptBudget::class, 'budget_id');
	}
}
