<?php

namespace App\Models\Landlord\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


/* IQBAL 12-FEB-23 */
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;
use App\Models\Landlord\Account;

use App\Models\Landlord\Lookup\Status;

use App\Enum\LandlordInvoiceStatusEnum;

class Invoice extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'summary', 'invoice_no', 'invoice_type', 'account_id', 'owner_id', 'invoice_date', 'from_date', 'to_date', 'org_from_date', 'due_date', 'currency', 'price', 'discount', 'subtotal', 'tax', 'vat', 'amount', 'amount_paid', 'pay_date', 'notes', 'adjusted', 'adjustment_date', 'adjustment_ref', 'status_code', 'updated_by', 'updated_at',
	];

	protected $casts = [
		'invoice_date'      => 'datetime',
		'start_date'        => 'datetime',
		'end_date'          => 'datetime',
		'updated_at'        => 'datetime',
		'created_at'        => 'datetime',
		'status_code'       => LandlordInvoiceStatusEnum::class,
	];

	/* ---------------- Scope ---------------------- */
	/**
	 * Scope a query to only include current users account.
	 */
	public function scopeByAccount(Builder $query): void
	{
		$query->where('account_id', auth()->user()->account_id);
	}


	/* ---------------- HasMany ---------------------- */
	public function payments()
	{
		return $this->hasMany(Payment::class);
	}

	/* ---------------- belongsTo ---------------------- */
	public function account()
	{
		return $this->belongsTo(Account::class, 'account_id');
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
	public function user_created_by()
	{
		return $this->belongsTo(User::class, 'created_by');
	}
	public function user_updated_by()
	{
		return $this->belongsTo(User::class, 'updated_by');
	}
}
