<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;


use App\Enum\Tenant\PaymentStatusEnum;
use App\Models\Tenant\Manage\Status;

use App\Models\Tenant\Po;
use App\Models\Tenant\Lookup\BankAccount;

use Illuminate\Database\Eloquent\Builder;

class Payment extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'invoice_id', 'po_id', 'pay_date', 'payee_id', 'summary', 'bank_account_id', 'cheque_no', 'currency', 'amount', 'fc_exchange_rate', 'fc_amount', 'dr_account', 'cr_account', 'for_entity', 'notes', 'error_code', 'accounted', 'status', 'updated_by', 'updated_at',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'updated_at'		=> 'datetime',
		'created_at'		=> 'datetime',
		'pay_date'			=> 'date',
		// DO NOT CAST. eager loading shows error
		//'status'			=> PaymentStatusEnum::class
	];

	/* ----------------- Scopes ------------------------- */

	public function scopeByCreator(Builder $query): void
	{
		$query->where('created_by', auth()->user()->id);
	}


	/**
	 * Scope a query to return all payment of PO's where he is the buyer.
	*/
	public function chkscopeByPoBuyer(Builder $query, $id): void
	{
		// P2
		// TODO
		// if (! $id) return;
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
	public function status_badge(){
		return $this->belongsTo(Status::class,'status')->withDefault([
			'name' => '[ Empty ]',
		]);
	}
	public function invoice(){
		return $this->belongsTo(Invoice::class,'invoice_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}

	public function po(){
		return $this->belongsTo(Po::class,'po_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}

	public function payee(){
		return $this->belongsTo(User::class,'payee_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}
	public function bank_account(){
		return $this->belongsTo(BankAccount::class,'bank_account_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}

}
