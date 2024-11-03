<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			Payment.php
* @brief		This file contains the implementation of the Payment
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
use App\Models\Landlord\Lookup\PaymentMethod;
use App\Models\Landlord\Manage\Status;

use App\Models\Landlord\Admin\Invoice;

//use App\Enum\Landlord\PaymentStatusEnum;
use App\Enum\Landlord\PaymentMethodEnum;

class Payment extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'summary', 'session_id', 'pay_date', 'invoice_id', 'account_id', 'owner_id', 'amount', 'currency', 'cheque_no', 'payment_token', 'reference_id', 'pwop', 'notes', 'ip', 'payment_method_code', 'status_code', 'updated_by', 'updated_at',
	];

	protected $casts = [
		'pay_date'		        => 'datetime',
		'updated_at'			=> 'datetime',
		'created_at'			=> 'datetime',
		'payment_method_code' 	=> PaymentMethodEnum::class,
		// DO NOT CAST. eager loading shows error
		//'status_code'	=> PaymentStatusEnum::class,
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


	/* ---------------- belongsTo ---------------------- */
	public function invoice()
	{
		return $this->belongsTo(Invoice::class, 'invoice_id');
	}

	public function account()
	{
		return $this->belongsTo(Account::class, 'account_id')->withDefault(['logo' => 'logo.png']);
	}

	public function payment_method()
	{
		return $this->belongsTo(PaymentMethod::class, 'payment_method_code');
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
