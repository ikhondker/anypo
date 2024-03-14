<?php

namespace App\Models\Tenant\Lookup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


use App\Traits\AddCreatedUpdatedBy;
use App\Models\Tenant\Lookup\Currency;


class PayMethod extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'name', 'pay_method_number', 'bank_name', 'branch_name', 'start_date', 'end_date', 'currency', 'notes', 'enable', 'updated_by', 'updated_at',
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

	 /* ----------------- Scopes ------------------------- */
	/**
	 * Scope a query to only include current account users.
	 */
	public function scopePrimary(Builder $query): void
	{
		$query->where('enable', true);
	}

	/* ----------------- HasMany ------------------------ */

	/* ----------------- belongsTo ---------------------- */
	public function currency() { 
		return $this->belongsTo(Currency::class); 
	}

}
