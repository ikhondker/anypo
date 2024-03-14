<?php

namespace App\Models\Tenant\Lookup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;

class Designation extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'name','enable','updated_at','updated_by'
	];

	/* ----------------- Functions ---------------------- */

	/* ----------------- Scopes ------------------------- */
	/**
	 * Scope a query to only  non-seeded users.
	 */
	public function scopePrimary(Builder $query): void
	{
		$query->where('enable', true)->orderBy('name', 'asc'); 
	}

	/* ----------------- HasMany ------------------------ */

	/* ----------------- HasMany ------------------------ */
	public function user_title() {
		return $this->hasMany(User::class);
	}

	/* ---------------- belongsTo ---------------------- */

}
