<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;
use App\Models\Tenant\Budget;
use App\Models\Tenant\Lookup\Dept;
use App\Models\Tenant\Project;

use App\Enum\EntityEnum;
use App\Enum\EventEnum;

use Illuminate\Database\Eloquent\Builder;

class Dbu extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'dept_budget_id', 'entity', 'article_id', 'event', 'user_id', 'dept_id', 'unit_id', 'project_id', 'supplier_id', 'amount_pr_booked', 'amount_pr', 'amount_po_booked', 'amount_po', 'amount_grs', 'amount_invoice', 'amount_payment', 'updated_by', 'updated_at',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'deleted_at'	=> 'datetime',
		'updated_at'	=> 'datetime',
		'created_at'	=> 'datetime',
		'entity'		=> EntityEnum::class,
		'event'			=> EventEnum::class,
	];


	/* ----------------- Scopes ------------------------- */

	/**
	 * Scope a query to only All PR for current user dept.
	*/
	public function scopeByDeptAll(Builder $query): void
	{
		$query->where('dept_id', auth()->user()->dept_id ); 
	}
	
	/* ---------------- belongsTo ---------------------- */
	public function deptBudget(){
		return $this->belongsTo(DeptBudget::class,'dept_budget_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}

	public function dept(){
		return $this->belongsTo(Dept::class,'dept_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}
	public function project(){
		return $this->belongsTo(Project::class,'project_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}

	public function user(){
		return $this->belongsTo(User::class,'user_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}


	/* ----------------- Scopes ------------------------- */

	/* ----------------- Functions ---------------------- */

	/* ----------------- HasMany ------------------------ */

}
