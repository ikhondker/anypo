<?php

namespace App\Models\Tenant\Lookup;

/* IQBAL 21-OCT-22 */
use App\Traits\AddCreatedUpdatedBy;
//use App\Models\User;
use App\Models\Tenant\Workflow\Hierarchy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dept extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'name', 'pr_hierarchy_id', 'po_hierarchy_id', 'text_color', 'bg_color', 'icon', 'enable', 'updated_by', 'updated_at',
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


	/* ----------------- Functions ---------------------- */
	public static function getAll()
	{
		return Dept::select('id', 'name')
			->where('enable', true)
			->orderBy('id', 'asc')
			->get();
	}

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

}
