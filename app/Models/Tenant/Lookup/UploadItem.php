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
		'owner_id', 'name', 'notes', 'code', 'category', 'oem', 'uom', 'price', 'account_type', 'status', 'remark', 'category_id', 'oem_id', 'uom_id', 'updated_at',
	];

	/* ----------------- HasMany ------------------------ */
	/* ---------------- belongsTo ---------------------- */
	public function owner() { 
		return $this->belongsTo(User::class,'owner_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}

}
