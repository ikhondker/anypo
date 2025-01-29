<?php

namespace App\Models\Landlord;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

use App\Traits\AddCreatedUpdatedBy;

use App\Models\User;

use App\Models\Landlord\Manage\Entity;

class Attachment extends Model
{
	use HasFactory, AddCreatedUpdatedBy;
	use HasUuids;

	protected $keyType		= 'string';
	public $incrementing 	= false;

	protected $fillable = [
		'entity', 'article_id', 'account_id', 'file_entity', 'owner_id', 'summary', 'file_name', 'file_type', 'file_size', 'org_file_name', 'upload_date', 'view_count', 'status', 'updated_by', 'updated_at',
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
		return $this->belongsTo(User::class,'owner_id')->withDefault([
			'name' => '[ Guest ]',
		]);
	}

	public function account()
	{
		return $this->belongsTo(Account::class,'account_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}

}
