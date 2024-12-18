<?php

namespace App\Models\Tenant\Lookup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;

use Illuminate\Database\Eloquent\Builder;

class Oem extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'name', 'text_color', 'bg_color', 'icon', 'enable', 'updated_by', 'updated_at',
	];

	/* ----------------- Scopes ------------------------- */
	/**
	 * Scope a query to only  non-seeded users.
	 */
	public function scopePrimary(Builder $query): void
	{
		$query->where('enable', true)->orderBy('name', 'asc');
	}

	/* ----------------- Functions ---------------------- */

	/* ----------------- HasMany ------------------------ */
	public function item(): HasMany
	{
		return $this->hasMany(Item::class, 'oem_id');
	}


	/* ---------------- belongsTo ---------------------- */

}
