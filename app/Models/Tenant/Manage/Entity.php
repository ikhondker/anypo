<?php

namespace App\Models\Tenant\Manage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;
use App\Models\Tenant\Attachment;

class Entity extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $primaryKey	= 'entity';
	public $incrementing 	= false;
	protected $keyType		= 'string';

	protected $fillable = [
		'entity', 'name', 'model', 'route', 'directory', 'notification', 'enable', 'updated_by', 'updated_at',
	];

	public static function libraryDocs() {
		return Entity::select('entity','name')
			->where('enable', true)
			->where('in_library', true)
			->orderBy('entity','asc')
			->get();
	}

	/* ----------------- HasMany ------------------------ */
	public function attachments(): HasMany {
		return $this->hasMany(Attachment::class,'entity');
	}
	public function attachmentfiles(): HasMany {
		return $this->hasMany(Attachment::class,'file_entity');
	}

	/* ---------------- belongsTo ---------------------- */


	/* ---------------- created and updated by ---------------------- */
	public function user_created_by(){
		return $this->belongsTo(User::class,'created_by');
	}
	public function user_updated_by(){
		return $this->belongsTo(User::class,'updated_by');
	}
}
