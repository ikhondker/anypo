<?php

namespace App\Models\Tenant\Lookup;

use App\Traits\AddCreatedUpdatedBy;
use App\Traits\standardWhoColumn;

//use App\Models\User;
use App\Models\Tenant\Workflow\Hierarchy;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use App\Models\Tenant\DeptBudget;
class Dept extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'name', 'pr_hierarchy_id', 'po_hierarchy_id', 'text_color', 'bg_color', 'icon', 'hod_id', 'enable', 'updated_by', 'updated_at',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'updated_at'	=> 'datetime',
		'created_at'	=> 'datetime',
	];



	/* ----------------- Scopes ------------------------- */
	/**
	 * Scope a query to only All Approved PR for tenant.
	*/
	public function scopePrimary(Builder $query): void
	{
		$query->where('enable', true)->orderBy('name', 'asc');
	}

	/* ----------------- Functions ---------------------- */


	/* ----------------- HasMany ------------------------ */
	public function deptBudgets(): HasMany
	{
		return $this->hasMany(DeptBudget::class, 'budget_id');
	}

	/* ---------------- belongsTo ---------------------- */
	public function prHierarchy(){
		return $this->belongsTo(Hierarchy::class,'pr_hierarchy_id');
	}

	public function poHierarchy(){
		return $this->belongsTo(Hierarchy::class,'po_hierarchy_id');
	}

	public function hod(){
		return $this->belongsTo(User::class,'hod_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}

	/* ---------------- created and updated by ---------------------- */
	// Replaced by trait AddCreatedUpdatedBy
	// public function user_created_by(){
	// 	return $this->belongsTo(User::class,'created_by')->withDefault([
	// 		'name' => '[ Empty ]',
	// 	]);
	// }
	// public function user_updated_by(){
	// 	return $this->belongsTo(User::class,'updated_by')->withDefault([
	// 		'name' => '[ Empty ]',
	// 	]);
	// }

}
