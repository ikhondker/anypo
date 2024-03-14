<?php

namespace App\Models\Tenant\Workflow;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;
use App\Models\Tenant\Workflow\Hierarchyl;

use Illuminate\Database\Eloquent\Builder;

class Hierarchy extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'name','enable','updated_at','updated_by'
	];
	

	/* ----------------- Scopes ------------------------- */
	/**
	 * Scope a query to only All Approved PR for tenant.
	*/
	public function scopePrimary(Builder $query): void
	{
		$query->where('enable',true); 
	}


	/* ----------------- Functions ---------------------- */
	
	 
	/* ----------------- HasMany ------------------------ */
	public function lines() {
		return $this->hasMany(Hierarchyl::class);
	}

	/* ---------------- belongsTo ---------------------- */

}
