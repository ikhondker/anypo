<?php

namespace App\Models\Tenant\Lookup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* IQBAL 21-OCT-22 */
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;


class UploadItem extends Model
{
	use HasFactory, AddCreatedUpdatedBy;
	
	protected $fillable = [
		'owner_id', 'name', 'code', 'category', 'oem', 'uom', 'gl_type_name', 'price', 'status', 'notes', 'category_id', 'oem_id', 'uom_class_id', 'uom_id', 'gl_type', 'updated_by', 'updated_at',
	];

	/* ----------------- HasMany ------------------------ */
	/* ---------------- belongsTo ---------------------- */
	public function owner() { 
		return $this->belongsTo(User::class,'owner_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}

}
