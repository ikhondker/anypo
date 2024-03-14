<?php

namespace App\Models\Tenant\Manage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;


class Status extends Model
{
	use HasFactory;
	use AddCreatedUpdatedBy;

	// protected $primaryKey 	= ['entity', 'code'];
	protected $primaryKey 	= 'code';
	public $incrementing 	= false;
	protected $keyType		= 'string';

	protected $fillable = [
		'code', 'name', 'badge', 'icon', 'enable', 'updated_by', 'updated_at',
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
}
