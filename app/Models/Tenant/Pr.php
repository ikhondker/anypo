<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* IQBAL 21-OCT-22 */
use App\Traits\AddCreatedUpdatedBy;

use App\Models\User;

use App\Models\Tenant\Prl;

use App\Models\Tenant\Lookup\Dept;
use App\Models\Tenant\Lookup\Supplier;
use App\Models\Tenant\Lookup\Project;
use App\Models\Tenant\Lookup\Currency;

use App\Enum\PrStatusEnum;
use App\Enum\AuthStatusEnum;
use Illuminate\Database\Eloquent\Builder;

class Pr extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'summary', 'pr_date', 'need_by_date', 'requestor_id', 'dept_id', 'project_id', 'dept_budget_id', 'supplier_id', 'notes', 'currency', 'sub_total', 'tax', 'vat', 'shipping', 'discount', 'amount', 'fc_currency', 'fc_exchange_rate', 'fc_amount', 'submission_date', 'status', 'auth_status', 'auth_date', 'auth_userid', 'wf_key', 'hierarchy_id', 'po_id', 'wf_id', 'updated_by', 'updated_at',
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
		'status'		=> PrStatusEnum::class,
		'auth_status'	=> AuthStatusEnum::class,
	];

	/* ----------------- Scopes ------------------------- */

	//$this->count_total		= Pr::count();
	//$this->count_approved	= Pr::where('auth_status',AuthStatusEnum::APPROVED->value )->count();
	//$this->count_inprocess	= Pr::where('auth_status',AuthStatusEnum::INPROCESS->value )->count();
	//$this->count_draft		= Pr::where('auth_status',AuthStatusEnum::DRAFT->value )->count();

	/**
	 * Scope a query to all PR of a Tenant.
	*/
	public function scopeAll(Builder $query): void
	{
		$query; 
	}
	
	public function scopeApprovedPoPending(Builder $query): void
	{
		$query->where('auth_status',AuthStatusEnum::APPROVED->value)
			->where('po_id',0); 
	}

	/**
	 * Scope a query to only All Approved PR for tenant.
	*/
	public function scopeAllApproved(Builder $query): void
	{
		$query->where('auth_status',AuthStatusEnum::APPROVED->value); 
	}

	/**
	 * Scope a query to only All InProcess PR for current tenant.
	*/
	public function scopeAllInProcess(Builder $query): void
	{
		$query->where('auth_status',AuthStatusEnum::INPROCESS->value);  
	}
	/**
	 * Scope a query to only All Draft PR for current tenant.
	*/
	public function scopeAllDraft(Builder $query): void
	{
		$query->where('auth_status',AuthStatusEnum::DRAFT->value);  ; 
	}


	/**
	 * Scope a query to only All PR for current user.
	*/
	public function scopeByUserAll(Builder $query): void
	{
		$query->where('requestor_id', auth()->user()->id ); 
	}

	/**
	 * Scope a query to only All Approved PR for current user.
	*/
	public function scopeByUserApproved(Builder $query): void
	{
		$query->where('requestor_id', auth()->user()->id )
		->where('auth_status',AuthStatusEnum::APPROVED->value); 
	}

	/**
	 * Scope a query to only All InProcess PR for current user.
	*/
	public function scopeByUserInProcess(Builder $query): void
	{
		$query->where('requestor_id', auth()->user()->id )
		->where('auth_status',AuthStatusEnum::INPROCESS->value);  
	}
	/**
	 * Scope a query to only All Draft PR for current user.
	*/
	public function scopeByUserDraft(Builder $query): void
	{
		$query->where('requestor_id', auth()->user()->id )
		->where('auth_status',AuthStatusEnum::DRAFT->value);  ; 
	}


	/**
	 * Scope a query to only All PR for current user dept.
	*/
	public function scopeByDeptAll(Builder $query): void
	{
		$query->where('dept_id', auth()->user()->dept_id ); 
	}

	/**
	 * Scope a query to only All Approved PR for current dept.
	*/
	public function scopeByDeptApproved(Builder $query): void
	{
		$query->where('dept_id', auth()->user()->dept_id)
		->where('auth_status',AuthStatusEnum::APPROVED->value); 
	}

	/**
	 * Scope a query to only All InProcess PR for current dept.
	*/
	public function scopeByDeptInProcess(Builder $query): void
	{
		$query->where('dept_id', auth()->user()->dept_id )
		->where('auth_status',AuthStatusEnum::INPROCESS->value);  
	}
	/**
	 * Scope a query to only All Draft PR for current dept.
	*/
	public function scopeByDeptDraft(Builder $query): void
	{
		$query->where('dept_id', auth()->user()->dept_id)
		->where('auth_status',AuthStatusEnum::DRAFT->value);  ; 
	}


	/* ----------------- Functions ---------------------- */
	
	/* ----------------- HasMany ------------------------ */
	public function prls() {
		return $this->hasMany(Prl::class);
	}

	/* ---------------- belongsTo ---------------------- */
	public function relDept(){
		return $this->belongsTo(Dept::class, 'dept_id');
	}
	public function relCurrency(){
		return $this->belongsTo(Currency::class, 'currency');
	}
	public function requestor(){
		return $this->belongsTo(User::class, 'requestor_id');
	}
	
	public function relSupplier(){
		return $this->belongsTo(Supplier::class, 'supplier_id');
	}
	public function relProject(){
		return $this->belongsTo(Project::class, 'project_id');
	}
	public function relRequestor(){
		return $this->belongsTo(User::class, 'requestor_id');
	}
}
