<?php

namespace App\Models\Tenant\Lookup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;

use App\Models\Tenant\Manage\CustomError;

class UploadItem extends Model
{
	use HasFactory, AddCreatedUpdatedBy;
	
	protected $fillable = [
		'owner_id', 'item_code', 'item_name', 'category_name', 'oem_name', 'uom_name', 'gl_type_name', 'ac_expense', 'price', 'status', 'notes', 'category_id', 'oem_id', 'uom_class_id', 'uom_id', 'gl_type', 'error_code', 'updated_by', 'updated_at',
	];

	/* ----------------- HasMany ------------------------ */
	/* ---------------- belongsTo ---------------------- */
	public function owner() { 
		return $this->belongsTo(User::class,'owner_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}

	public function customError(){
		return $this->belongsTo(CustomError::class,'error_code')->withDefault([
			'name' => '[ Empty ]',
		]);
	}

}
