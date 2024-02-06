<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/* IQBAL 21-OCT-22 */
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;
use App\Models\Tenant\Budget;
use App\Models\Tenant\Lookup\Dept;

class DeptBudget extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'budget_id', 'dept_id', 'amount', 'amount_pr_booked', 'amount_pr_issued', 'amount_po_booked', 'amount_po_issued', 'amount_grs', 'amount_payment', 'end_date', 'notes', 'closed', 'updated_by', 'updated_at',
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
	public function scopeByDeptFy(Builder $query): void
	{
			$query->whereHas('budget', function ($q) {
                $q->where('fy',  date('Y'));
            })
			->where('dept_id', auth()->user()->dept_id ); 
	}


	/* ----------------- Functions ---------------------- */
	public static function tbdgetAll() {
		return User::select('id','name')
			->where('enable', true)
			->orderBy('id','asc')
			->get();
	}



	/* ---------------- belongsTo ---------------------- */
	public function budget(){
		return $this->belongsTo(Budget::class,'budget_id');
	}

	public function dept(){
		return $this->belongsTo(Dept::class,'dept_id');
	}

	/* ---------------- created and updated by ---------------------- */
	public function user_created_by(){
		return $this->belongsTo(User::class,'created_by');
	}
	public function user_updated_by(){
		return $this->belongsTo(User::class,'updated_by');
	}
}
