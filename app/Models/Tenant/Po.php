<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* IQBAL 21-OCT-22 */
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;

use App\Models\Tenant\Pol;

use App\Models\Tenant\Lookup\Dept;
use App\Models\Tenant\Lookup\Supplier;
use App\Models\Tenant\Lookup\Project;
use App\Models\Tenant\Lookup\Currency;

use App\Enum\ClosureStatusEnum;
use App\Enum\AuthStatusEnum;
use Illuminate\Database\Eloquent\Builder;


class Po extends Model
{
	use HasFactory;
	use AddCreatedUpdatedBy;

	protected $fillable = [
		'summary', 'po_date', 'need_by_date', 'requestor_id', 'dept_id', 'project_id', 'dept_budget_id', 'supplier_id', 'notes', 'currency', 'sub_total', 'tax', 'vat', 'shipping', 'discount', 'amount', 'fc_currency', 'fc_exchange_rate', 'fc_amount', 'submission_date', 'status', 'auth_status', 'auth_date', 'auth_userid', 'wf_key', 'hierarchy_id', 'po_id', 'wf_id', 'updated_by', 'updated_at',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'deleted_at'	=> 'datetime',
		'updated_at'	=> 'datetime',
		'created_at'	=> 'datetime',
		'closure_status'		=> ClosureStatusEnum::class,
		'auth_status'	=> AuthStatusEnum::class,
	];

	/* ----------------- Functions ---------------------- */
	/* ----------------- HasMany ------------------------ */
	public function pols() {
		return $this->hasMany(Pol::class);
	}

	/* ---------------- belongsTo ---------------------- */
	public function relDept(){
		return $this->belongsTo(Dept::class,'dept_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}
	public function relCurrency(){
		return $this->belongsTo(Currency::class,'currency')->withDefault([
			'name' => '[ Empty ]',
		]);
	}
	public function requestor(){
		return $this->belongsTo(User::class,'requestor_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}
	public function relSupplier(){
		return $this->belongsTo(Supplier::class,'supplier_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}
	public function relProject(){
		return $this->belongsTo(Project::class,'project_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}


}
