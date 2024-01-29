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

use App\Enum\ClosureStatusEnum;
use App\Enum\AuthStatusEnum;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Support\Facades\Log;
use DB;

class Pr extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'summary', 'pr_date', 'need_by_date', 'requestor_id', 'dept_id', 'unit_id', 'project_id', 'dept_budget_id', 'supplier_id', 'notes', 'currency', 'sub_total', 'tax', 'gst', 'amount', 'fc_currency', 'fc_exchange_rate', 'fc_amount', 'submission_date', 'status', 'auth_status', 'auth_date', 'auth_user_id', 'wf_key', 'hierarchy_id', 'po_id', 'wf_id', 'updated_by', 'updated_at',
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

	public static function updateFcValues($id)
	{

		$setup = Setup::first();
		$pr				= Pr::where('id', $id)->firstOrFail();
		$rate = ExchangeRate::getRate($pr->currency, $setup->currency);


		// populate Pr fc columns

		Prl::where('pr_id', $pr->id)
		->update([
			'category_id'	=> $category_id,
			'oem_id'		=> $oem_id,
			'uom_id'		=> $uom_id,
			'gl_type'		=> $gl_type,
			'status'		=> InterfaceStatusEnum::VALIDATED->value,
			]);


		// Cancel All PO Lines
			Prl::where('pr_id',$pr->id)
				  ->update(['status' => ClosureStatusEnum::CANCELED->value]);

		// update PR header
		$pr				= Pr::where('id', $id)->firstOrFail();
		$result= Prl::where('pr_id', $pr->id)->get( array(
			DB::raw('SUM(sub_total) as sub_total'),
			DB::raw('SUM(tax) as tax'),
			DB::raw('SUM(gst) as gst'),
			DB::raw('SUM(amount) as amount'),
		));
		
		//Log::debug('Value of id=' . $rs);
		//Log::debug('Value of tax=' . $r->tax);

		foreach($result as $row) {
			Log::debug('results sub_total ='. $row['sub_total']);
			Log::debug('results tax ='. $row['tax']);
			Log::debug('results gst ='. $row['gst']);
			Log::debug('results amount ='. $row['amount']);

			$pr->sub_total	= $row['sub_total'] ;
			$pr->tax		= $row['tax'] ;
			$pr->gst		= $row['gst'] ;
			$pr->amount		= $row['amount'];
		}
	
		$pr->save();

		return 0;
	}

	public static function updatePrHeaderValue($id)
	{

		// update PR header
		$pr				= Pr::where('id', $id)->firstOrFail();
		$result= Prl::where('pr_id', $pr->id)->get( array(
			DB::raw('SUM(sub_total) as sub_total'),
			DB::raw('SUM(tax) as tax'),
			DB::raw('SUM(gst) as gst'),
			DB::raw('SUM(amount) as amount'),
		));
		
		//Log::debug('Value of id=' . $rs);
		//Log::debug('Value of tax=' . $r->tax);

		foreach($result as $row) {
			Log::debug('results sub_total ='. $row['sub_total']);
			Log::debug('results tax ='. $row['tax']);
			Log::debug('results gst ='. $row['gst']);
			Log::debug('results amount ='. $row['amount']);

			$pr->sub_total	= $row['sub_total'] ;
			$pr->tax		= $row['tax'] ;
			$pr->gst		= $row['gst'] ;
			$pr->amount		= $row['amount'];
		}
	
		$pr->save();

		return 0;
	}

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

	/**
	 * Scope a query to only All Draft PR for current dept.
	*/
	public function scopeCreatedBetweenDates(Builder $query): void
	{
		$query->whereDate('pr_date', '>=', $dates[0])
			->whereDate('pr_date', '<=', $dates[1]);
	}


	/* ----------------- Functions ---------------------- */
	
	/* ----------------- HasMany ------------------------ */
	public function prls() {
		return $this->hasMany(Prl::class);
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
