<?php

namespace App\Models\Landlord\Manage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;

class Process extends Model
{
	//use HasFactory, AddCreatedUpdatedBy;
	use HasFactory;
	protected $fillable = [
		'job_code', 'parameter', 'status', 'updated_at',
	];
}
