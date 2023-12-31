<?php

namespace App\Models\Landlord\Manage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* IQBAL 21-OCT-22 */
use App\Traits\AddCreatedUpdatedBy;

use App\Models\User;

use App\Models\Landlord\Manage\Entity;

class Attachment extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'entity', 'article_id', 'file_entity', 'owner_id', 'summary', 'file_name', 'file_type', 'file_size', 'org_file_name', 'upload_date', 'view_count', 'status', 'updated_by', 'updated_at',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'upload_date'	=> 'datetime',
		'updated_at'	=> 'datetime',
		'created_at'	=> 'datetime',
	];

	/* ---------------- HasMany ---------------------- */

	/* ---------------- belongsTo ---------------------- */
	public function entity()
	{
		return $this->belongsTo(Entity::class, 'entity');
	}

	public function entityfile()
	{
		return $this->belongsTo(Entity::class, 'entity');
	}

	public function owner()
	{
		return $this->belongsTo(User::class, 'owner_id');
	}

	// public function entity(){
	//     return $this->belongsTo(Entity::class,'entity');
	// }

	// public function file_entity(){
	//     return $this->belongsTo(Entity::class,'file_entity');
	// }

	/* ---------------- created and updated by ---------------------- */
	public function user_created_by()
	{
		return $this->belongsTo(User::class, 'created_by');
	}
	public function user_updated_by()
	{
		return $this->belongsTo(User::class, 'updated_by');
	}
}
