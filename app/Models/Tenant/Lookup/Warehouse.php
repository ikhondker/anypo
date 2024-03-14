<?php

namespace App\Models\Tenant\Lookup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;

use App\Models\Tenant\Receipts;
use App\Models\Tenant\Lookup\Country;

use Illuminate\Database\Eloquent\Builder;

class Warehouse extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'name', 'contact_person', 'cell', 'address1', 'address2', 'city', 'zip', 'state', 'country', 'website', 'email', 'enable', 'updated_by', 'updated_at',
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
	public function receipts() {
		return $this->hasMany(Receipts::class);
	}

	/* ---------------- belongsTo ---------------------- */
	public function relCountry(){
		return $this->belongsTo(Country::class,'country');
	}


}
