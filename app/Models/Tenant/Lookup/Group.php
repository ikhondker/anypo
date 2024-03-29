<?php

namespace App\Models\Tenant\Lookup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;

class Group extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'name','enable','updated_at','updated_by'
	];
	/* ----------------- Functions ---------------------- */

	/* ----------------- HasMany ------------------------ */
	/* ---------------- belongsTo ---------------------- */

}
