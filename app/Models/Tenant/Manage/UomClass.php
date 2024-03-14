<?php

namespace App\Models\Tenant\Manage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;

use App\Models\Tenant\Lookup\Uom;

class UomClass extends Model
{
    use HasFactory;
	use AddCreatedUpdatedBy;

    protected $fillable = [
		'name','enable','updated_at','updated_by'
	];

	/* ----------------- HasMany ------------------------ */
	public function uom(): HasMany
	{
		return $this->hasMany(Uom::class,'uom_class_id');
	}

	/* ---------------- belongsTo ---------------------- */
}
