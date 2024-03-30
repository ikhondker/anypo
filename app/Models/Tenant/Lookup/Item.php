<?php

namespace App\Models\Tenant\Lookup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;

use App\Models\Tenant\Manage\UomClass;

use Illuminate\Database\Eloquent\Builder;

class Item extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'code', 'name', 'notes', 'category_id', 'oem_id', 'uom_class_id', 'uom_id', 'gl_type_code', 'dr_account', 'cr_account', 'price', 'stock', 'reorder', 'photo', 'enable', 'updated_by', 'updated_at',
	];


	
	/* ----------------- Scopes ------------------------- */
	/**
	 * Scope a query to only Tenant Active users.
	*/
	public function scopePrimary(Builder $query): void
	{
		$query->where('enable', true)
			->orderBy('id', 'asc'); 
	}

	/* ----------------- Functions ---------------------- */
		
	
	/* ----------------- HasMany ------------------------ */
	public function prl() {
		return $this->hasMany(Prl::class);
	}

	public function pol() {
		return $this->hasMany(Pol::class);
	}

	/* ---------------- belongsTo ---------------------- */
	public function category(){
		return $this->belongsTo(Category::class,'category_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}

	public function oem(){
		return $this->belongsTo(Oem::class,'oem_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}

	public function uom_class(){
		return $this->belongsTo(UomClass::class,'uom_class_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}
	public function uom(){
		return $this->belongsTo(Uom::class,'uom_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}

	public function glType(){
		return $this->belongsTo(GlType::class,'gl_type_code')->withDefault([
			'name' => '[ Empty ]',
		]);
	}

}
