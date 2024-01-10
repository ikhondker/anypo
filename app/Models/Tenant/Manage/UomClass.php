<?php

namespace App\Models\Tenant\Manage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* IQBAL 21-OCT-22 */
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;


class UomClass extends Model
{
    use HasFactory;
	use AddCreatedUpdatedBy;

    protected $fillable = [
		'name','enable','updated_at','updated_by'
	];

	/* ----------------- HasMany ------------------------ */
	public function item(): HasMany
	{
		return $this->hasMany(Item::class, 'uom_id');
	}

}
