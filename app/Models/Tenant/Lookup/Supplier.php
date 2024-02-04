<?php

namespace App\Models\Tenant\Lookup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* IQBAL 21-OCT-22 */
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;
use App\Models\Tenant\Lookup\Country;

use Illuminate\Database\Eloquent\Builder;

class Supplier extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'name', 'address1', 'address2', 'contact_person', 'cell', 'city', 'zip', 'state', 'country', 'website', 'email', 'enable', 'updated_by', 'updated_at',
	];

	/* ----------------- Scopes ------------------------- */
	/**
	 * Scope a query to only All Approved PR for tenant.
	*/
	public function scopePrimary(Builder $query): void
	{
		$query->where('enable',true)->orderBy('name', 'asc'); 
	}

	/* ----------------- Functions ---------------------- */
	public static function tbdgetAll() {
		return Supplier::select('id', 'name')
			->where('enable', true)
			->orderBy('id', 'asc')
			->get();
	}

	public static function getAll1() {
		return Supplier::select('id', 'name')
			->where('enable', true)
			->orderBy('id', 'asc')
			->get();
	}
	/* ---------------- belongsTo ---------------------- */
	public function relCountry(){
		return $this->belongsTo(Country::class,'country');
	}

}
