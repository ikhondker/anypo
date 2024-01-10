<?php

namespace App\Models\Tenant\Lookup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* IQBAL 21-OCT-22 */
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;

use App\Models\Tenant\Manage\UomClass;

use Illuminate\Database\Eloquent\Builder;

class Uom extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'name','enable','updated_at','updated_by'
	];

	/* ----------------- Scopes ------------------------- */
	/**
	 * Scope a query to only  non-seeded users.
	 */
	public function scopePrimary(Builder $query): void
	{
		$query->where('enable', true);
	}

	/* ----------------- Functions ---------------------- */
	public static function getAll() {
		returnUom::select('id','name')
			->where('enable', true)
			->orderBy('id','asc')
			->get();
	}

	
	/* ----------------- HasMany ------------------------ */

	

	/* ---------------- belongsTo ---------------------- */
	public function uom_class(){
		return $this->belongsTo(UomClass::class,'uom_class_id');
	}
}
