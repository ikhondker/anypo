<?php

namespace App\Models\Tenant;


use App\Traits\AddCreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Support\Facades\Log;

use App\Models\User;
//use App\Models\DeptBudget;

use DB;

class Budget extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'fy', 'name', 'start_date', 'end_date', 'amount', 'amount_pr_booked', 'amount_pr', 'amount_po_booked', 'amount_po_tax', 'amount_po_gst', 'amount_po', 'amount_grs', 'amount_invoice', 'amount_payment', 'count_pr_booked', 'count_pr', 'count_po_booked', 'count_po', 'count_grs', 'count_invoice', 'count_payment', 'notes', 'revision', 'parent_id', 'revision_dept_budget_id', 'text_color', 'bg_color', 'icon', 'closed', 'updated_by', 'updated_at',
	];

	/* ----------------- Scopes ------------------------- */
	/**
	 * Scope a query to only include current account users.
	 */
	public function scopePrimary(Builder $query): void
	{
		$query->where('closed', false)
			->where('revision', false);
	}

	public function scopeAllRevisions(Builder $query): void
	{
		$query->where('revision', true);
	}

	/**
	 * Scope a query to only All PR for current user dept.
	*/
	public function chkscopeByFy(Builder $query): void
	{
		$query->where('fy', date('Y'));
	}


	/* ----------------- Functions ---------------------- */

	/* ----------------- HasMany ------------------------ */
	public function deptBudgets(): HasMany
	{
		return $this->hasMany(DeptBudget::class, 'budget_id');
	}


	/* ---------------- created and updated by ---------------------- */
	public function user_created_by(){
		return $this->belongsTo(User::class,'created_by');
	}
	public function user_updated_by(){
		return $this->belongsTo(User::class,'updated_by');
	}
}
