<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;

use App\Helpers\Tenant\ExchangeRate;

use App\Models\Tenant\Prl;
use App\Models\Tenant\Admin\Setup;

use App\Models\Tenant\Lookup\Dept;
use App\Models\Tenant\Lookup\Supplier;
use App\Models\Tenant\Lookup\Project;
//use App\Models\Tenant\Lookup\Currency;
use App\Models\Tenant\Lookup\Category;

use App\Models\Tenant\Manage\Status;

use App\Models\Tenant\Workflow\Hierarchy;

use App\Enum\Tenant\ClosureStatusEnum;
use App\Enum\Tenant\AuthStatusEnum;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Support\Facades\Log;
use DB;

class Pr extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'summary', 'pr_date', 'need_by_date', 'requestor_id', 'dept_id', 'unit_id', 'project_id', 'category_id', 'dept_budget_id', 'supplier_id', 'notes', 'currency', 'sub_total', 'tax', 'gst', 'amount', 'fc_currency', 'fc_exchange_rate', 'fc_sub_total', 'fc_tax', 'fc_gst', 'fc_amount', 'submission_date', 'po_id', 'status', 'auth_status', 'auth_date', 'auth_user_id', 'error_code', 'wf_key', 'hierarchy_id', 'wf_id', 'updated_by', 'updated_at',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'deleted_at'		=> 'datetime',
		'updated_at'		=> 'datetime',
		'created_at'		=> 'datetime',
		'pr_date'			=> 'date',
		// DO NOT CAST. eager loading shows error
		//'status'			=> ClosureStatusEnum::class,
		//'auth_status'		=> AuthStatusEnum::class,
	];


	/* ----------------- Functions ---------------------- */

	// sync header and FC values PR header and lines
	public static function syncPrValues($pr_id)
	{

		Log::debug('tenant.model.pr.syncPrValues pr_id = '. $pr_id);
		$setup 	= Setup::first();
		//$pr		= Pr::where('id', $pr_id)->firstOrFail();

		// update PR header
		//Log::debug('tenant.model.pr.syncPrValues retrieving detail for pr_id = '. $pr_id);
		$pr		= Pr::where('id', $pr_id)->firstOrFail();
		$result = Prl::where('pr_id', $pr->id)->get( array(
			DB::raw('SUM(sub_total) as sub_total'),
			DB::raw('SUM(tax) as tax'),
			DB::raw('SUM(gst) as gst'),
			DB::raw('SUM(amount) as amount'),
		));

		Log::debug('tenant.model.pr.syncPrValues updating PR header pr_id = '. $pr_id);
		// No row in child table
		foreach($result as $row) {
			if ( is_null($row['sub_total']) ) {
				Log::debug('tenant.model.pr.syncPrValues no row in prl for pr_id = '. $pr_id);
				$pr->sub_total		= 0;
				$pr->tax			= 0 ;
				$pr->gst			= 0 ;
				$pr->amount			= 0;
			} else {
				//Log::debug('tenant.model.pr.syncPrValues rows found in prl for pr_id = '. $pr_id);
				$pr->sub_total	= $row['sub_total'] ;
				$pr->tax		= $row['tax'] ;
				$pr->gst		= $row['gst'] ;
				$pr->amount		= $row['amount'];
			}
		}
		$pr->save();

		// get updated PR header
		$pr				= Pr::where('id', $pr_id)->firstOrFail();
		if ($pr->currency == $setup->currency){
			$rate = 1;
			DB::statement("UPDATE prls SET
				fc_sub_total	= sub_total,
				fc_tax			= tax,
				fc_gst			= gst,
				fc_amount		= amount
				WHERE pr_id = ".$pr_id."");
		} else {
			Log::debug('tenant.model.pr.syncPrValues PR currency = ' . $pr->currency.' fc_currency = '.$setup->currency);
			Log::debug('tenant.model.pr.syncPrValues calling ExchangeRate::getRate ...');
			$rate = round(ExchangeRate::getRate($pr->currency, $setup->currency),6);

			// Show error if rate not found
			if ($rate == 0){
				Log::error('tenant.model.pr.syncPrValues Exchange rate not found for PR currency = ' . $pr->currency.' fc_currency = '.$setup->currency);
				return 'E015';
			} else {
				Log::debug('tenant.model.pr.syncPrValues Exchange rate = ' . $rate);
			}

			// update all prls fc columns
			Log::debug('tenant.model.pr.syncPrValues populating FC values prls table.');
			DB::statement("UPDATE prls SET
				fc_sub_total	= round(sub_total * ".$rate.",2),
				fc_tax			= round(tax * ".$rate.",2),
				fc_gst			= round(gst * ".$rate.",2),
				fc_amount		= round(amount * ".$rate.",2)
				WHERE pr_id = ".$pr_id."");
		}

		// TODOP2 handle in better way
		Log::debug('tenant.model.pr.syncPrValues Updating header FC column pr_id = ' . $pr->id);

		// check if rows exists in prl
		$count_prl		= Prl::where('pr_id',$pr->id)->count();
		if ($count_prl == 0 ){
			Log::debug('tenant.model.pr.syncPrValues NO row found in prls table .');
			$pr->fc_sub_total		= 0 ;
			$pr->fc_tax				= 0 ;
			$pr->fc_gst				= 0 ;
			$pr->fc_amount			= 0;
		} else {
			//Log::debug('tenant.model.pr.syncPrValues updating pr header FC columns.');
			// get prl summary
			$result= Prl::where('pr_id', $pr_id)->get( array(
				DB::raw('SUM(fc_sub_total) as fc_sub_total'),
				DB::raw('SUM(fc_tax) as fc_tax'),
				DB::raw('SUM(fc_gst) as fc_gst'),
				DB::raw('SUM(fc_amount) as fc_amount'),
			));
			foreach($result as $row) {
				$pr->fc_sub_total		= $row['fc_sub_total'] ;
				$pr->fc_tax				= $row['fc_tax'] ;
				$pr->fc_gst				= $row['fc_gst'] ;
				$pr->fc_amount			= $row['fc_amount'];
			}
		}
		$pr->fc_exchange_rate	= $rate;

		$pr->save();
		Log::debug('tenant.model.pr.syncPrValues pr table updated with pr->fc_amount = '.$pr->fc_amount);

		return '';
	}

	// insert prls into pols user in convertToPo and addToPO
	public static function insertPrlsIntoPols($prId, $poId)
	{

		Log::debug('tenant.pr.insertPrlsIntoPols FROM pr_id = ' . $prId);
		Log::debug('tenant.pr.insertPrlsIntoPols TO po_id = ' . $poId);
		// get last line num from POL
		$last_pol_line_num = Pol::where('po_id', $poId )->max('line_num');
		Log::debug('tenant.model.pr.insertPrlsIntoPols max prl line_num = '.$last_pol_line_num);
		if (empty($last_pol_line_num)){
			$last_pol_line_num = 0;
		}

		$prls	= Prl::with('pr')->where('pr_id', $prId)->get();
		foreach ($prls as $prl) {
			// create invoice lines with line number
			$pol			= new Pol();

			$pol->po_id 		= $poId;
			$pol->line_num 		= $last_pol_line_num + 1 ;

			Log::debug('tenant.model.pr.insertPrlsIntoPols max prl line_num $prl->id = '.$prl->id);
			Log::debug('tenant.model.pr.insertPrlsIntoPols max prl line_num $prl->item_description = '.$prl->item_description);

			$pol->item_description = $prl->item_description;
			$pol->item_id 		= $prl->item_id;
			$pol->uom_id 		= $prl->uom_id;
			$pol->qty 			= $prl->qty;
			$pol->price 		= $prl->price;
			$pol->sub_total		= $prl->sub_total;
			$pol->tax			= $prl->tax;
			$pol->gst			= $prl->gst;
			$pol->amount		= $prl->amount;
			$pol->notes			= $prl->notes;
			$pol->requestor_id	= $prl->pr->requestor_id;
			$pol->dept_id 		= $prl->pr->dept_id;
			$pol->unit_id		= $prl->pr->unit_id;
			$pol->project_id 	= $prl->pr->project_id;
			$pol->prl_id		= $prl->id ;
			$pol->closure_status=ClosureStatusEnum::OPEN->value;
			$pol->save();

			// increment counter
			$last_pol_line_num = $last_pol_line_num + 1 ;
		}


	}
	/* ----------------- Scopes ------------------------- */

	//$this->count_total		= Pr::count();
	//$this->count_approved	= Pr::where('auth_status',AuthStatusEnum::APPROVED->value )->count();
	//$this->count_inprocess	= Pr::where('auth_status',AuthStatusEnum::INPROCESS->value )->count();
	//$this->count_draft		= Pr::where('auth_status',AuthStatusEnum::DRAFT->value )->count();

	/**
	* ==================================================================================
	* 1. Scope All
	* ==================================================================================
	*/
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
			->where('po_id', 0);
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
	public function scopeAllRejected(Builder $query): void
	{
		$query->where('auth_status',AuthStatusEnum::REJECTED->value);
	}
	/**
	 * Scope a query to only All Converted to PO, PR for current tenant.
	*/
	public function scopeAllConverted(Builder $query): void
	{
		$query->where('auth_status',AuthStatusEnum::APPROVED->value)
			->where('po_id', '<>', 0);
	}

	/**
	* ==================================================================================
	* 1. Scope By user
	* ==================================================================================
	*/
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
	public function scopeByUserRejected(Builder $query): void
	{
		$query->where('requestor_id', auth()->user()->id )
			->where('auth_status',AuthStatusEnum::REJECTED->value);
	}
	/**
	 * Scope a query to only All Draft PR for current user.
	*/
	public function scopeByUserConverted(Builder $query): void
	{
		$query->where('requestor_id', auth()->user()->id )
			->where('auth_status',AuthStatusEnum::APPROVED->value)
			->where('po_id', '<>', 0); ;
	}

	/**
	* ==================================================================================
	* 1. Scope By Dept
	* ==================================================================================
	*/
	/**
	 * Scope a query to only All PR for current user dept.
	*/
	public function scopeByDeptAll(Builder $query): void
	{
		$query->where('dept_id', auth()->user()->dept_id )
		->where('auth_status','<>',AuthStatusEnum::DRAFT->value);
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
	public function scopeByDeptRejected(Builder $query): void
	{
		$query->where('dept_id', auth()->user()->dept_id)
			->where('auth_status',AuthStatusEnum::REJECTED->value);
	}
/**
	 * Scope a query to only All Draft PR for current dept.
	*/
	public function scopeByDeptConverted(Builder $query): void
	{
		$query->where('dept_id', auth()->user()->dept_id)
			->where('auth_status',AuthStatusEnum::APPROVED->value)
			->where('po_id', '<>', 0); ;
	}

	/**
	* ==================================================================================
	* 1. Scope By Others
	* ==================================================================================
	*/


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
	public function requestor(){
		return $this->belongsTo(User::class,'requestor_id')->withDefault([
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

	public function category(){
		return $this->belongsTo(Category::class,'category_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}

	public function hierarchy(){
		return $this->belongsTo(Hierarchy::class,'hierarchy_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}

}
