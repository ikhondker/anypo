<?php

namespace App\Models\Tenant\Lookup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* IQBAL 21-OCT-22 */
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;

class Group extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'name','enable','updated_at','updated_by'
	];
	/* ----------------- Functions ---------------------- */

	public static function getAll() {
		return Group::select('id','name')
			->where('enable', true)
			->orderBy('id','asc')
			->get();
	}

	/* ----------------- HasMany ------------------------ */
	/* ---------------- belongsTo ---------------------- */

}
