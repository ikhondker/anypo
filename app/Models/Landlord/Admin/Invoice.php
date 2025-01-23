<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			Invoice.php
* @brief		This file contains the implementation of the Invoice
* @path			\app\Models\Landlord\Admin
* @author		Iqbal H. Khondker <ihk@khondker.com>
* @created		10-DEC-2023
* @copyright	(c) Iqbal H. Khondker
* =====================================================================================
* Revision History:
* Date			Version	Author				Comments
* -------------------------------------------------------------------------------------
* 10-DEC-2023	v1.0.0	Iqbal H Khondker	Created
* DD-MON-YYYY	v1.0.1	Iqbal H Khondker	Modification brief
* =====================================================================================
*/
namespace App\Models\Landlord\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;



use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;
use App\Models\Landlord\Account;

use App\Models\Landlord\Manage\Status;

use App\Enum\Landlord\InvoiceStatusEnum;

class Invoice extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'summary', 'invoice_no', 'invoice_type','posted', 'account_id', 'owner_id', 'invoice_date', 'from_date', 'org_from_date', 'to_date', 'due_date', 'currency', 'price', 'subtotal', 'discount', 'tax', 'vat', 'amount', 'org_amount', 'amount_paid', 'pay_date', 'discount_date', 'discount_by', 'pwop', 'pwop_date', 'pwop_paid_by', 'notes', 'notes_internal', 'adjusted', 'adjustment_date', 'adjustment_ref', 'status_code', 'process_id', 'updated_by', 'updated_at',
	];

	protected $casts = [
		'invoice_date'	=> 'datetime',
		'start_date'	=> 'datetime',
		'end_date'		=> 'datetime',
		'updated_at'	=> 'datetime',
		'created_at'	=> 'datetime',
		// DO NOT CAST. eager loading shows error
		//'status_code'	=> InvoiceStatusEnum::class,
	];

	/* ---------------- Scope ---------------------- */
	/**
	 * Scope a query to only include current users account.
	 */
	public function scopeByAccount(Builder $query): void
	{
		$query->where('account_id', auth()->user()->account_id)
			->where('status_code', '<>',InvoiceStatusEnum::DRAFT->value );
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

	// /* ---------------- created and updated by ---------------------- */
	// public function user_created_by()
	// {
	// 	return $this->belongsTo(User::class, 'created_by');
	// }
	// public function user_updated_by()
	// {
	// 	return $this->belongsTo(User::class, 'updated_by');
	// }
}
