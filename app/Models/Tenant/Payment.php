<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* IQBAL 21-OCT-22 */
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;

use App\Models\Tenant\Po;
use App\Models\Tenant\Lookup\BankAccount;

use Illuminate\Database\Eloquent\Builder;

class Payment extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'pay_date', 'payee_id', 'po_id', 'bank_account_id', 'cheque_no', 'currency', 'amount', 'fc_currency', 'fc_exchange_rate', 'fc_amount', 'for_entity', 'notes', 'status', 'updated_by', 'updated_at',
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
