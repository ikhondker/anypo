<?php

namespace App\Models\Tenant\Lookup;


use App\Traits\AddCreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Builder;

use App\Models\Tenant\Payment;

class BankAccount extends Model
{
	use HasFactory;
	use AddCreatedUpdatedBy;

	protected $fillable = [
		'ac_name', 'ac_number', 'routing_number', 'bank_name', 'branch_name', 'start_date', 'end_date', 'currency', 'ac_bank', 'contact_person', 'cell', 'address1', 'address2', 'city', 'zip', 'state', 'country', 'website', 'email', 'enable', 'text_color', 'bg_color', 'icon', 'updated_by', 'updated_at',
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
	public function payments() {
		return $this->hasMany(Payment::class);
	}

	/* ---------------- belongsTo ---------------------- */
	public function relCountry(){
		return $this->belongsTo(Country::class,'country');
	}

	/* ---------------- belongsTo ---------------------- */


}
