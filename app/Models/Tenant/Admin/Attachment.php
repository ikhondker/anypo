<?php

namespace App\Models\Tenant\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* IQBAL 21-OCT-22 */
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;
use App\Models\Tenant\Manage\Entity;

use Illuminate\Database\Eloquent\SoftDeletes;

class Attachment extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	use SoftDeletes;

	protected $casts = [
		'deleted_at' => 'datetime',
		'updated_at' => 'datetime',
		'created_at' => 'datetime',
	];


	protected $fillable = [
		'entity', 'article_id', 'file_entity', 'owner_id', 'summary', 'file_name', 'file_type', 'file_size', 'org_file_name', 'upload_date', 'view_count', 'status', 'updated_by', 'updated_at',
	];

	/* ----------------- Functions ---------------------- */


	/* ----------------- Scopes ------------------------- */


	/* ----------------- HasMany ------------------------ */
	 
	/* ----------------- belongsTo ---------------------- */
	public function entity(){
		return $this->belongsTo(Entity::class,'entity');
	}
	 public function owner(){
		return $this->belongsTo(User::class,'owner_id');
	}
}


