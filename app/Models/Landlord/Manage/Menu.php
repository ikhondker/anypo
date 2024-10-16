<?php

namespace App\Models\Landlord\Manage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* IQBAL 12-FEB-23 */
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;

use App\Enum\Tenant\MenuAccessEnum;

class Menu extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'raw_route_name', 'route_name', 'access', 'enable', 'updated_by', 'updated_at',
	];

	protected $casts = [
		'updated_at'	=> 'datetime',
		'created_at'	=> 'datetime',
		//'access'		=> MenuAccessEnum::class,
	];


	/* ---------------- Scope ---------------------- */


	/* ---------------- HasMany ---------------------- */

	/* ---------------- belongsTo ---------------------- */
}
