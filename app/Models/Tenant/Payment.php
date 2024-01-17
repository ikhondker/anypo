<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* IQBAL 21-OCT-22 */
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;


class Payment extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'pay_date', 'payee_id', 'po_id', 'bank_account_id', 'cheque_no', 'currency', 'amount', 'fc_currency', 'fc_exchange_rate', 'fc_amount', 'for_entity', 'notes', 'status', 'updated_by', 'updated_at',
	];
	/* ----------------- Functions ---------------------- */
	/* ----------------- HasMany ------------------------ */
	/* ---------------- belongsTo ---------------------- */

	
}
