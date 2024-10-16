<?php

namespace App\Models\Tenant\Workflow;


use App\Traits\AddCreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Tenant\Workflow\Wf;

use App\Enum\Tenant\WflActionEnum;
use App\Models\Tenant\Manage\Status;

class Wfl extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'wf_id', 'sequence', 'performer_id', 'assign_date', 'action_date', 'action', 'notes', 'error_code', 'updated_by', 'updated_at',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'updated_at'	=> 'datetime',
		'created_at'	=> 'datetime',
		'action'	=> WflActionEnum::class,
	];


	/* ----------------- Functions ---------------------- */
	/* ----------------- HasMany ------------------------ */
	/* ---------------- belongsTo ---------------------- */
	public function wf(){
		return $this->belongsTo(Wf::class,'wf_id');
	}

	public function performer(){
		return $this->belongsTo(User::class,'performer_id');
	}

	/* ---------------- belongsTo ---------------------- */
	public function action_badge(){
		return $this->belongsTo(Status::class,'action')->withDefault([
			'name' => '[ Empty ]',
		]);
	}


}
