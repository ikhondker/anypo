<?php

namespace App\Models\Tenant\Workflow;


use App\Traits\AddCreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Tenant\Workflow\Wfl;
use App\Models\Tenant\Workflow\Hierarchy;

use App\Enum\Tenant\WfStatusEnum;
use App\Enum\Tenant\AuthStatusEnum;


class Wf extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'entity', 'article_id', 'hierarchy_id', 'wf_status', 'auth_status', 'auth_user_id', 'auth_date', 'updated_by', 'updated_at',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'updated_at'	=> 'datetime',
		'created_at'	=> 'datetime',
		'wf_status'		=> WfStatusEnum::class,
		'auth_status'	=> AuthStatusEnum::class
	];

	/* ---------------- belongsTo ---------------------- */
	public function relHierarchy(){
		return $this->belongsTo(Hierarchy::class,'hierarchy_id');
	}

	public function last_performer(){
		return $this->belongsTo(User::class, 'auth_user_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}

	/* ----------------- HasMany ------------------------ */
	public function wfl() {
		return $this->hasMany(Wfl::class,'id');
	}
}
