<?php

namespace App\Models\Tenant\Workflow;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* IQBAL 21-OCT-22 */
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;
use App\Models\Tenant\Workflow\Hierarchyl;

class Hierarchy extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'name','enable','updated_at','updated_by'
	];
	
	/* ----------------- Functions ---------------------- */
	public static function tbdgetAll()
	{
		 return Hierarchy::select('id', 'name')
			 ->where('enable', true)
			 ->orderBy('id', 'asc')
			 ->get();
	 }

	 
	/* ----------------- HasMany ------------------------ */
	public function lines() {
		return $this->hasMany(Hierarchyl::class);
	}

	/* ---------------- belongsTo ---------------------- */

}
