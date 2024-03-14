<?php

namespace App\Models\Tenant\Lookup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;


class Rate extends Model
{
	use HasFactory;
	use AddCreatedUpdatedBy;

	protected $fillable = [
		'rate_date', 'currency', 'fc_currency', 'from_date', 'to_date', 'rate', 'inverse_rate', 'updated_by', 'updated_at',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'updated_at' => 'datetime',
		'created_at' => 'datetime',
	];
}
