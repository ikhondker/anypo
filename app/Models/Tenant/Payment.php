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
		'pay_date', 'payee_id', 'summary', 'bank_account_id', 'cheque_no', 'amount', 'base_currency', 'base_exchange_rate', 'base_amount', 'for_entity', 'po_id', 'article_id', 'notes', 'status', 'updated_by', 'updated_at',
	];
	/* ----------------- Functions ---------------------- */
	/* ----------------- HasMany ------------------------ */
	/* ---------------- belongsTo ---------------------- */

	
}
