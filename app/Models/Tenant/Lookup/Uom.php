<?php

namespace App\Models\Tenant\Lookup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;

use App\Models\Tenant\Manage\UomClass;

use Illuminate\Database\Eloquent\Builder;

class Uom extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'name', 'uom_class_id', 'conversion', 'text_color', 'bg_color', 'icon', 'default', 'enable', 'updated_by', 'updated_at',
	];

	/* ----------------- Scopes ------------------------- */
	/**
	 * Scope a query to only  non-seeded users.
	 */
	public function scopePrimary(Builder $query): void
	{
		$query->where('enable', true);
	}

	/**
	 * Scope a query to return UoM of a uom_class.
	 */
	public function scopebyUomClass(Builder $query,$uom_class_id=1001): void
	{
		$query->WHERE('uom_class_id',$uom_class_id)
		->where('enable', true);
	}

	/* ----------------- Functions ---------------------- */


	/* ----------------- HasMany ------------------------ */
	public function item() {
		return $this->hasMany(Item::class);
	}
	public function prl() {
		return $this->hasMany(Prl::class);
	}

	/* ---------------- belongsTo ---------------------- */
	public function uom_class(){
		return $this->belongsTo(UomClass::class,'uom_class_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}
}
