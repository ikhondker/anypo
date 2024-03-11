<?php

namespace App\Models\Landlord\Manage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* IQBAL 21-OCT-22 */
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;
//use App\Models\Entity;
//use App\Models\Wf;


class Entity extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $primaryKey	= 'entity';
	protected $keyType		= 'string';

	protected $fillable = [
		'entity', 'name', 'model', 'route', 'directory', 'notification', 'enable', 'updated_by', 'updated_at',
	];

	public static function libraryDocs()
	{
		return Entity::select('entity', 'name')
			->where('enable', true)
			->where('in_library', true)
			->orderBy('entity', 'asc')
			->get();
	}

	/* ---------------- HasMany ---------------------- */
	public function attachments(): HasMany
	{
		return $this->hasMany(Attachment::class, 'entity');
	}
	public function attachmentfiles(): HasMany
	{
		return $this->hasMany(Attachment::class, 'file_entity');
	}

	/* ---------------- belongsTo ---------------------- */

}
