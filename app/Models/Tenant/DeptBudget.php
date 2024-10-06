<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


use App\Traits\AddCreatedUpdatedBy;
use App\Traits\CreatedUpdatedBy;

use App\Models\User;
use App\Models\Tenant\Budget;
use App\Models\Tenant\Lookup\Dept;


class DeptBudget extends Model
{
	use HasFactory, AddCreatedUpdatedBy,CreatedUpdatedBy;

	protected $fillable = [
		'budget_id', 'dept_id', 'amount', 'amount_pr_booked', 'amount_pr', 'amount_po_booked', 'amount_po', 'amount_grs', 'amount_invoice', 'amount_payment', 'count_pr_booked', 'count_pr', 'count_po_booked', 'count_po', 'count_grs', 'count_invoice', 'count_payment', 'start_date', 'end_date', 'notes', 'revision', 'parent_id', 'closed', 'updated_by', 'updated_at',
	];
/*
	|-----------------------------------------------------------------------------
	| Functions
	|-----------------------------------------------------------------------------
	*/

	/* ----------------- Scopes ------------------------- */
	/**
	 * Scope a query to only include current account users.
	 */
	public function scopePrimary(Builder $query): void
	{
		$query->where('closed', false)
			->where('revision', false);
	}

	/**
	 * Scope a query to only All PR for current user dept.
	*/
	public function scopeByDeptAll(Builder $query): void
	{
		$query->where('dept_id', auth()->user()->dept_id )
			->where('revision', false);
	}

	/**
	 * Scope a query to only All PR for current user dept.
	*/
	public function scopeByDeptAllRevisions(Builder $query): void
	{
		$query->where('dept_id', auth()->user()->dept_id )
			->where('revision', true);
	}

	/**
	 * Scope a query to only All PR for current user dept.
	*/
	public function chkscopeByDeptFy(Builder $query): void
	{
			$query->whereHas('budget', function ($q) {
				$q->where('fy', date('Y'));
			})
			->where('dept_id', auth()->user()->dept_id );
	}


	/* ----------------- Functions ---------------------- */


	/* ---------------- belongsTo ---------------------- */
	public function budget(){
		return $this->belongsTo(Budget::class,'budget_id');
	}

	public function dept(){
		return $this->belongsTo(Dept::class,'dept_id');
	}

}
