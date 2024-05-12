<?php

namespace App\Models\Landlord\Manage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ErrorLog extends Model
{
	use HasFactory;

	protected $fillable = [
		'tenant', 'url', 'user_id','role','e_class', 'message', 'status', 'updated_at',
	];

}
