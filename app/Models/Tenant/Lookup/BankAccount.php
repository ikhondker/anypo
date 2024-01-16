<?php

namespace App\Models\Tenant\Lookup;

/* IQBAL 21-OCT-22 */
use App\Traits\AddCreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Builder;

class BankAccount extends Model
{
    use HasFactory;
	use AddCreatedUpdatedBy;

	protected $fillable = [
		'ac_name', 'ac_number', 'bank_name', 'branch_name', 'start_date', 'end_date', 'currency', 'contact_person', 'cell', 'address1', 'address2', 'city', 'zip', 'state', 'country', 'website', 'email', 'enable', 'updated_by', 'updated_at',
	];


	/* ----------------- Scopes ------------------------- */
	/**
	 * Scope a query to only  non-seeded users.
	 */
	public function scopePrimary(Builder $query): void
	{
		$query->where('enable', true);
	}
}
