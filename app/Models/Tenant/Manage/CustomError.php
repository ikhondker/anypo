<?php

namespace App\Models\Tenant\Manage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;


class CustomError extends Model
{
	use HasFactory, AddCreatedUpdatedBy;
	
	protected $primaryKey	= 'code';
	public $incrementing 	= false;
	protected $keyType		= 'string';

	protected $fillable = [
		'code', 'entity', 'message', 'enable', 'updated_by', 'updated_at',

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
