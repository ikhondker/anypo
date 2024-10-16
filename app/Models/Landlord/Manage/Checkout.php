<?php

namespace App\Models\Landlord\Manage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;

use App\Models\Landlord\Lookup\Product;
use App\Models\Landlord\Manage\Status;

use App\Enum\Landlord\InvoiceTypeEnum;

class Checkout extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'checkout_date', 'invoice_type', 'session_id', 'site', 'email', 'account_name', 'existing_user', 'owner_id', 'account_id', 'invoice_id', 'start_date', 'end_date', 'product_id', 'product_name', 'tax', 'vat', 'price', 'mnth', 'user', 'gb', 'status_code', 'ip', 'address1', 'address2', 'city', 'state', 'zip', 'country', 'updated_by', 'updated_at',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'checkout_date'	=> 'datetime',
		'start_date'	=> 'date',
		'end_date'		=> 'date',
		'updated_at'	=> 'datetime',
		'created_at'	=> 'datetime',
		'invoice_type'	=> InvoiceTypeEnum::class,
		// DO NOT CAST. eager loading shows error
		//'status_code'	=> CheckoutStatusEnum::class,
	];

	/* ---------------- HasMany ---------------------- */

	/* ---------------- belongsTo ---------------------- */
	public function product()
	{
		return $this->belongsTo(Product::class, 'product_id');
	}

	public function owner()
	{
		return $this->belongsTo(User::class, 'owner_id');
	}
	public function status()
	{
		return $this->belongsTo(Status::class, 'status_code');
	}

	/* ---------------- created and updated by ---------------------- */
}
