<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* IQBAL 21-OCT-22 */
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;

use App\Helpers\ExchangeRate;

use App\Models\Tenant\Pol;
use App\Models\Tenant\Admin\Setup;

use App\Models\Tenant\Lookup\Dept;
use App\Models\Tenant\Lookup\Supplier;
use App\Models\Tenant\Lookup\Project;
use App\Models\Tenant\Lookup\Currency;

use App\Models\Tenant\Manage\Status;

use App\Enum\ClosureStatusEnum;
use App\Enum\AuthStatusEnum;

use Illuminate\Database\Eloquent\Builder;
 
use Illuminate\Support\Facades\Log;

use DB;

class Po extends Model
{
	use HasFactory;
	use AddCreatedUpdatedBy;

	protected $fillable = [
		'summary', 'buyer_id', 'po_date', 'need_by_date', 'requestor_id', 'dept_id', 'unit_id', 'project_id', 'dept_budget_id', 'supplier_id', 'notes', 'currency', 'sub_total', 'tax', 'gst', 'amount', 'submission_date', 'fc_currency', 'fc_exchange_rate', 'fc_sub_total', 'fc_tax', 'fc_gst', 'fc_amount', 'amount_grs', 'fc_amount_grs', 'amount_invoice', 'fc_amount_invoice', 'amount_paid', 'fc_amount_paid', 'status', 'payment_status', 'auth_status', 'auth_date', 'auth_user_id', 'wf_key', 'hierarchy_id', 'pr_id', 'wf_id', 'updated_by', 'updated_at',
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
		'po_date'			=> 'date',
		// DO NOT CAST. eager loading shows error
		// 'closure_status'		=> ClosureStatusEnum::class,
		// 'auth_status'	=> AuthStatusEnum::class,
	];


	/* ----------------- Functions ---------------------- */
	// populate functions currency columns in PO header nad lines
	public static function updatePoFcValues($po_id)
	{

		$setup 	= Setup::first();
		$po		= Po::where('id', $po_id)->firstOrFail();

		//Log::debug('updatePoFcValues =' . $po->currency.$setup->currency);

		// populate fc columns for all pol lines
		if ($po->currency == $setup->currency){
			$rate = 1;
			DB::statement("UPDATE pols SET 
				fc_sub_total	= sub_total,
				fc_tax			= tax,
				fc_gst			= gst,
				fc_amount		= amount
				WHERE po_id = ".$po_id."");
		} else {
			$rate = round(ExchangeRate::getRate($po->currency, $setup->currency),6);
			// update all pols fc columns
			// update pr fc columns
			// ERROR rate not found 
			if ($rate == 0){
				Log::error('pr.updatePrFcValues rate not found currency=' . $po->currency.' fc_currency='.$setup->currency);
				return false;
			}

			DB::statement("UPDATE pols SET 
				fc_sub_total	= round(sub_total * ". $rate .",2),
				fc_tax			= round(tax * ". $rate .",2),
				fc_gst			= round(gst * ". $rate .",2),
				fc_amount		= round(amount * ". $rate .",2)
				fc_grs_price	= round(grs_price * ". $rate .",2)
				WHERE po_id = ". $po_id);
		}

		// get prl summary
		$result= Pol::where('po_id', $po_id)->get( array(
			DB::raw('SUM(fc_sub_total) as fc_sub_total'),
			DB::raw('SUM(fc_tax) as fc_tax'),
			DB::raw('SUM(fc_gst) as fc_gst'),
			DB::raw('SUM(fc_amount) as fc_amount'),
		));
		
		//Log::debug('Value of id=' . $rs);
		//Log::debug('Value of tax=' . $r->tax);

		// update PR header
		foreach($result as $row) {
			$po->fc_exchange_rate	= $rate;
			$po->fc_sub_total		= $row['fc_sub_total'] ;
			$po->fc_tax				= $row['fc_tax'] ;
			$po->fc_gst				= $row['fc_gst'] ;
			$po->fc_amount			= $row['fc_amount'];
		}
	
		$po->save();

		return true;
	}

	// populate PO headed amount columns based on child rows
	public static function updatePoHeaderValue($id)
	{

		//Log::debug('updatePoHeaderValue id=' . $id);
		// update PR header
		$po				= Po::where('id', $id)->firstOrFail();
		$result= Pol::where('po_id', $po->id)->get( array(
			DB::raw('SUM(sub_total) as sub_total'),
			DB::raw('SUM(tax) as tax'),
			DB::raw('SUM(gst) as gst'),
			DB::raw('SUM(amount) as amount'),
		));
		
		foreach($result as $row) {
			$po->sub_total	= $row['sub_total'] ;
			$po->tax		= $row['tax'] ;
			$po->gst		= $row['gst'] ;
			$po->amount		= $row['amount'];
		}
	
		$po->save();

		return 0;
	}

	/* ----------------- Scopes ------------------------- */

	//$this->count_total		= Po::count();
	//$this->count_approved		= Po::where('auth_status',AuthStatusEnum::APPROVED->value )->count();
	//$this->count_inprocess	= Po::where('auth_status',AuthStatusEnum::INPROCESS->value )->count();
	//$this->count_draft		= Po::where('auth_status',AuthStatusEnum::DRAFT->value )->count();

	/**
	 * Scope a query to all PR of a Tenant.
	*/
	public function scopeAll(Builder $query): void
	{
		$query; 
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
	 * Scope a query to only All PO for current user.
	*/
	public function scopeByBuyerAll(Builder $query): void
	{
		$query->where('buyer_id', auth()->user()->id ); 
	}

	/**
	 * Scope a query to only All Approved PR for current user.
	*/
	public function scopeByBuyerApproved(Builder $query): void
	{
		$query->where('buyer_id', auth()->user()->id )
		->where('auth_status',AuthStatusEnum::APPROVED->value); 
	}

	/**
	 * Scope a query to only All InProcess PR for current user.
	*/
	public function scopeByBuyerInProcess(Builder $query): void
	{
		$query->where('buyer_id', auth()->user()->id )
		->where('auth_status',AuthStatusEnum::INPROCESS->value);  
	}
	/**
	 * Scope a query to only All Draft PR for current user.
	*/
	public function scopeByBuyerDraft(Builder $query): void
	{
		$query->where('buyer_id', auth()->user()->id )
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
		$query->whereDate('po_date', '>=', $dates[0])
			->whereDate('po_date', '<=', $dates[1]);
	}


	/* ----------------- Functions ---------------------- */

	
	/* ----------------- HasMany ------------------------ */
	public function pols() {
		return $this->hasMany(Pol::class);
	}

	/* ---------------- belongsTo ---------------------- */

	public function status_badge(){
		return $this->belongsTo(Status::class,'status')->withDefault([
			'name' => '[ Empty ]',
		]);
	}
	public function auth_status_badge(){
		return $this->belongsTo(Status::class,'auth_status')->withDefault([
			'name' => '[ Empty ]',
		]);
	}


	public function dept(){
		return $this->belongsTo(Dept::class,'dept_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}
	public function xxrelCurrency(){
		return $this->belongsTo(Currency::class,'currency')->withDefault([
			'name' => '[ Empty ]',
		]);
	}
	public function requestor(){
		return $this->belongsTo(User::class,'requestor_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}
	public function buyer(){
		return $this->belongsTo(User::class,'buyer_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}

	public function supplier(){
		return $this->belongsTo(Supplier::class,'supplier_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}
	public function project(){
		return $this->belongsTo(Project::class,'project_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}


}
