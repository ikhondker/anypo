<?php

namespace App\Models\Landlord\Manage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;


class MailList extends Model
{
		use HasFactory, AddCreatedUpdatedBy;

		protected $fillable = [
			'email', 'user_id', 'ip', 'enable', 'updated_by', 'updated_at',
	];

}
