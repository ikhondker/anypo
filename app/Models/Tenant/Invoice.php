<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* IQBAL 21-OCT-22 */
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;

use App\Enum\InvoiceStatusEnum;
use App\Enum\PaymentStatusEnum;

class Invoice extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'invoice_no', 'invoice_date', 'po_id', 'summary', 'poc_id', 'currency', 'sub_total', 'tax', 'gst', 'amount', 'paid_amount', 'fc_exchange_rate', 'fc_sub_total', 'fc_tax', 'fc_gst', 'fc_amount', 'fc_paid_amount', 'dr_account', 'cr_account', 'notes', 'status', 'payment_status', 'updated_by', 'updated_at',
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
		'status'			=> InvoiceStatusEnum::class,
		'payment_status'	=> PaymentStatusEnum::class,
	];

	/* ----------------- Scopes ------------------------- */
	/**
	 * Scope a query to return all payment of PO's where he is the buyer.
	*/
	public function scopeByPoBuyer(Builder $query, $id): void
	{
		// TODO
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


	/* ---------------- belongsTo ---------------------- */
	/* ----------------- HasMany ------------------------ */


	/* ---------------- belongsTo ---------------------- */
	public function po(){
		return $this->belongsTo(Po::class,'po_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}
	public function poc(){
		return $this->belongsTo(User::class,'poc_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}
}
