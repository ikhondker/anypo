<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* IQBAL 21-OCT-22 */
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;


class Receipt extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'receive_date', 'rcv_type', 'pol_id', 'warehouse_id', 'receiver_id', 'qty', 'notes', 'status', 'updated_by', 'updated_at',
	];
	/* ----------------- Functions ---------------------- */
	/* ----------------- HasMany ------------------------ */
	/* ---------------- belongsTo ---------------------- */


}
