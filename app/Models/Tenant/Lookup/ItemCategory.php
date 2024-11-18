<?php

namespace App\Models\Tenant\Lookup;


use App\Traits\AddCreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Builder;

//use App\Models\Tenant\Lookup\Item;

class ItemCategory extends Model
{
	use HasFactory;
	use AddCreatedUpdatedBy;

	protected $fillable = [
		'name', 'tax_pc', 'gst_pc', 'group_id', 'text_color', 'bg_color', 'icon', 'enable', 'updated_by', 'updated_at',
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
