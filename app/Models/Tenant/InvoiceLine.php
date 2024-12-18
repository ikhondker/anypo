<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;



class InvoiceLine extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'invoice_id', 'line_num', 'summary', 'qty', 'price', 'sub_total', 'tax', 'gst', 'amount', 'fc_sub_total', 'fc_tax', 'fc_gst', 'fc_amount', 'notes', 'error_code', 'closure_status', 'updated_by', 'updated_at',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'updated_at'		=> 'datetime',
		'created_at'		=> 'datetime',
	];


	/* ----------------- Functions ---------------------- */

	/* ----------------- HasMany ------------------------ */


	/* ---------------- belongsTo ---------------------- */
	public function invoice(){
		return $this->belongsTo(Invoice::class,'invoice_id');
	}
}
