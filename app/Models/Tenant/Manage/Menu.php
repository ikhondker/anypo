<?php

namespace App\Models\Tenant\Manage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* IQBAL 21-OCT-22 */
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;


class Menu extends Model
{
	use HasFactory;
	use AddCreatedUpdatedBy;

	protected $fillable = [
		'raw_route_name', 'route_name', 'node_name', 'enable', 'updated_by', 'updated_at',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'updated_at'        => 'datetime',
		'created_at'        => 'datetime',
	];
}
