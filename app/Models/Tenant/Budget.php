<?php

namespace App\Models\Tenant;

/* IQBAL 21-OCT-22 */
use App\Traits\AddCreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

//use App\Models\User;
//use App\Models\DeptBudget;

class Budget extends Model
{
	use HasFactory;
	use AddCreatedUpdatedBy;

	protected $fillable = [
		'fy', 'name', 'start_date', 'end_date', 'currency', 'amount', 'amount_pr_booked', 'amount_pr_issued', 'amount_po_booked', 'amount_po_issued', 'amount_grs', 'amount_payment', 'notes', 'text_color', 'bg_color', 'icon', 'freeze', 'updated_by', 'updated_at',
	];

	/* ----------------- Scopes ------------------------- */
	/**
	 * Scope a query to only include current account users.
	 */
	public function scopePrimary(Builder $query): void
	{
		$query->where('freeze', false);
	} 


	/* ----------------- Functions ---------------------- */
	public static function getAll()
	{
		return Budget::select('id', 'name')
			->where('enable', true)
			->orderBy('id', 'asc')
			->get();
	}

	/* ----------------- HasMany ------------------------ */
	public function deptBudgets(): HasMany
	{
		return $this->hasMany(DeptBudget::class, 'dept_id');
	}
}
