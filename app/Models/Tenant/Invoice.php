<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;

use App\Models\Tenant\Lookup\Supplier;

use App\Helpers\Tenant\ExchangeRate;

use Illuminate\Support\Facades\Log;

use App\Models\Tenant\Manage\Status;

use Illuminate\Database\Eloquent\Builder;

//use App\Helpers\Tenant\ExchangeRate;

use App\Enum\Tenant\InvoiceStatusEnum;
//use App\Enum\Tenant\PaymentStatusEnum;

use App\Models\Tenant\Admin\Setup;

use DB;

class Invoice extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'invoice_type', 'invoice_no', 'invoice_date', 'po_id', 'supplier_id', 'summary', 'poc_id', 'currency', 'sub_total', 'tax', 'gst', 'amount', 'amount_paid', 'fc_currency', 'fc_exchange_rate', 'fc_sub_total', 'fc_tax', 'fc_gst', 'fc_amount', 'fc_amount_paid', 'dr_account', 'cr_account', 'notes', 'error_code', 'accounted', 'status', 'payment_status', 'updated_by', 'updated_at',
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
		'po_date'			=> 'date',
		// DO NOT CAST. eager loading shows error
		//'status'			=> InvoiceStatusEnum::class,
		//'payment_status'	=> PaymentStatusEnum::class,
	];

	/* ----------------- Scopes ------------------------- */

	public function scopeAll(Builder $query): void
	{
		$query;
	}

	/**
	 * Scope a query to only All Approved PR for tenant.
	*/
	public function scopeAllPosted(Builder $query): void
	{
		$query->where('status',InvoiceStatusEnum::POSTED->value);
	}

	/**
	 * Scope a query to only All Approved PR for tenant.
	*/
	public function scopePaymentDue(Builder $query): void
	{
		$query->where('status', InvoiceStatusEnum::POSTED->value);
		// TODO ->where('payment_status',);
		// PaymentStatusEnum::DUE or PaymentStatusEnum::PARTIAL
	}

	/**
	 * Scope a query to return all payment of PO's where he is the buyer.
	*/
	public function scopeByPoBuyer(Builder $query, $id): void
	{
		// TODOP2
		//if (! $id) return;
		$query->whereHas('po', function ($q) use ($id) {
			$q->where('buyer_id', $id);
		});
	}

	/**
	 *  Scope a query to return all payment of PO's of his dept.
	*/
	public function scopeByPoDept(Builder $query,$id): void
	{
		$query->whereHas('po', function ($q) use ($id) {
			$q->where('dept_id', $id);
		});
	}

	/* ----------------- Functions ---------------------- */

	// sync header and FC values PR header and lines
	public static function syncInvoiceValues($invoice_id)
	{

		Log::debug('tenant.model.pr.syncInvoiceValues invoice_id = '. $invoice_id);
		$setup 	= Setup::first();
		//$pr		= Pr::where('id', $invoice_id)->firstOrFail();

		// update Invoice header
		$invoice		= Invoice::where('id', $invoice_id)->firstOrFail();
		$result = InvoiceLine::where('invoice_id', $invoice->id)->get( array(
			DB::raw('SUM(sub_total) as sub_total'),
			DB::raw('SUM(tax) as tax'),
			DB::raw('SUM(gst) as gst'),
			DB::raw('SUM(amount) as amount'),
		));

		Log::debug('tenant.model.invoice.syncInvoiceValues updating PR header invoice_id = '. $invoice_id);
		// No row in child table
		foreach($result as $row) {
			if ( is_null($row['sub_total']) ) {
				Log::debug('tenant.model.invoice.syncInvoiceValues no row in prl for invoice_id = '. $invoice_id);
				$invoice->sub_total		= 0;
				$invoice->tax			= 0 ;
				$invoice->gst			= 0 ;
				$invoice->amount			= 0;
			} else {
				$invoice->sub_total	= $row['sub_total'] ;
				$invoice->tax		= $row['tax'] ;
				$invoice->gst		= $row['gst'] ;
				$invoice->amount		= $row['amount'];
			}
		}
		$invoice->save();

		// get updated Invoice header
		$invoice				= Invoice::where('id', $invoice_id)->firstOrFail();
		if ($invoice->currency == $setup->currency){
			$rate = 1;
			DB::statement("UPDATE invoice_lines SET
				fc_sub_total	= sub_total,
				fc_tax			= tax,
				fc_gst			= gst,
				fc_amount		= amount
				WHERE invoice_id = ".$invoice_id."");
		} else {
			Log::debug('tenant.model.invoice.syncPrValues INV currency = ' . $invoice->currency.' fc_currency = '.$setup->currency);
			Log::debug('tenant.model.invoice.syncInvoiceValues calling ExchangeRate::getRate ...');
			$rate = round(ExchangeRate::getRate($invoice->currency, $setup->currency),6);

			// Show error if rate not found
			if ($rate == 0){
				Log::error('tenant.model.invoice.syncInvoiceValues Exchange rate not found for PR currency = ' . $invoice->currency.' fc_currency = '.$setup->currency);
				return 'E015';
			} else {
				Log::debug('tenant.model.invoice.syncInvoiceValues Exchange rate = ' . $rate);
			}

			// update all invoice_lines fc columns
			Log::debug('tenant.model.invoice.syncInvoiceValues populating FC values invoice_lines table.');
			DB::statement("UPDATE invoice_lines SET
				fc_sub_total	= round(sub_total * ".$rate.",2),
				fc_tax			= round(tax * ".$rate.",2),
				fc_gst			= round(gst * ".$rate.",2),
				fc_amount		= round(amount * ".$rate.",2)
				WHERE invoice_id = ".$invoice_id."");
		}

		// TODOP2 handle in better way
		Log::debug('tenant.model.invoice.syncInvoiceValues Updating header FC column Invoice = ' . $invoice->id);

		// check if rows exists in prl
		$count_invl		= InvoiceLine::where('invoice_id',$invoice->id)->count();
		if ($count_invl == 0 ){
			Log::debug('tenant.model.invoice.syncInvoiceValues NO row found in invoice_lines table .');
			$invoice->fc_sub_total		= 0 ;
			$invoice->fc_tax				= 0 ;
			$invoice->fc_gst				= 0 ;
			$invoice->fc_amount			= 0;
		} else {
			//Log::debug('tenant.model.pr.syncPrValues updating pr header FC columns.');
			// get prl summary
			$result= InvoiceLine::where('invoice_id', $invoice_id)->get( array(
				DB::raw('SUM(fc_sub_total) as fc_sub_total'),
				DB::raw('SUM(fc_tax) as fc_tax'),
				DB::raw('SUM(fc_gst) as fc_gst'),
				DB::raw('SUM(fc_amount) as fc_amount'),
			));
			foreach($result as $row) {
				$invoice->fc_sub_total		= $row['fc_sub_total'] ;
				$invoice->fc_tax				= $row['fc_tax'] ;
				$invoice->fc_gst				= $row['fc_gst'] ;
				$invoice->fc_amount			= $row['fc_amount'];
			}
		}
		$invoice->fc_exchange_rate	= $rate;

		$invoice->save();
		Log::debug('tenant.model.invoice.syncInvoiceValues pr table updated with invoice->fc_amount = '.$invoice->fc_amount);

		return '';
	}



	/* ----------------- HasMany ------------------------ */


	/* ---------------- belongsTo ---------------------- */

	public function status_badge(){
		return $this->belongsTo(Status::class,'status')->withDefault([
			'name' => '[ Empty ]',
		]);
	}
	public function pay_status_badge(){
		return $this->belongsTo(Status::class,'payment_status')->withDefault([
			'name' => '[ Empty ]',
		]);
	}

	public function po(){
		return $this->belongsTo(Po::class,'po_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}

	public function supplier(){
		return $this->belongsTo(Supplier::class,'supplier_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}

	public function poc(){
		return $this->belongsTo(User::class,'poc_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}

	/* ---------------- created and updated by ---------------------- */
	public function createdBy(){
		return $this->belongsTo(User::class,'created_by');
	}
	public function updatedBy(){
		return $this->belongsTo(User::class,'updated_by');
	}

}
