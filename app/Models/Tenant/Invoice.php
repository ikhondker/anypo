<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;

use App\Models\Tenant\Lookup\Supplier;

use App\Models\Tenant\Manage\Status;

use Illuminate\Database\Eloquent\Builder;

//use App\Helpers\Tenant\ExchangeRate;

use App\Enum\InvoiceStatusEnum;
//use App\Enum\PaymentStatusEnum;

use App\Models\Tenant\Admin\Setup;

use DB;

class Invoice extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'invoice_no', 'invoice_date', 'invoice_type', 'po_id', 'supplier_id', 'summary', 'poc_id', 'currency', 'sub_total', 'tax', 'gst', 'amount', 'paid_amount', 'fc_exchange_rate', 'fc_sub_total', 'fc_tax', 'fc_gst', 'fc_amount', 'fc_paid_amount', 'dr_account', 'cr_account', 'notes', 'error_code', 'accounted', 'status', 'payment_status', 'updated_by', 'updated_at',
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
	 * Scope a query to return all payment of PO's where he is the buyer.
	*/
	public function scopeByPoBuyer(Builder $query, $id): void
	{
		// P2
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
