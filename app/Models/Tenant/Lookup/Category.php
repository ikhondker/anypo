<?php

namespace App\Models\Tenant\Lookup;


use App\Traits\AddCreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Builder;

//use App\Models\Tenant\Lookup\Item;

class Category extends Model
{
	use HasFactory;
	use AddCreatedUpdatedBy;

	protected $fillable = [
		'name', 'enable', 'updated_at', 'updated_by',
	];


	/* ----------------- Scopes ------------------------- */
	/**
	 * Scope a query to only  non-seeded users.
	 */
	public function scopePrimary(Builder $query): void
	{
		$query->where('enable', true);
	}


	/* ----------------- Functions ---------------------- */
	
	
	/* ----------------- HasMany ------------------------ */
	public function item(): HasMany
	{
		return $this->hasMany(Item::class, 'category_id');
	}
	/* ---------------- belongsTo ---------------------- */

}
