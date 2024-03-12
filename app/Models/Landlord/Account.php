<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			Account.php
* @brief		This file contains the implementation of the Account
* @path			\app\Models\Landlord
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
namespace App\Models\Landlord;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/* IQBAL 12-FEB-23 */
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;

use App\Models\Landlord\Lookup\Country;
use App\Models\Landlord\Manage\Status;

use App\Enum\LandlordAccountStatusEnum;

class Account extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'site', 'name', 'currency', 'tagline', 'address1', 'address2', 'city', 'state', 'zip', 'country', 'website', 'facebook', 'linkedin', 'email', 'cell', 'owner_id', 'primary_product_id', 'base_mnth', 'base_user', 'base_gb', 'base_price', 'mnth', 'user', 'gb', 'price', 'start_date', 'end_date', 'next_bill_generated', 'next_invoice_no', 'last_bill_date', 'expired_at', 'count_user', 'count_product', 'used_gb', 'maintenance', 'status_code', 'logo', 'updated_by', 'updated_at',
	];

	protected $casts = [
		'start_date'			=> 'date',
		'end_date'				=> 'date',
		//'last_bill_from_date'	=> 'datetime',
		//'last_bill_to_date'	=> 'datetime',
		'expired_at'			=> 'date',
		'updated_at'			=> 'datetime',
		'created_at'			=> 'datetime',
		// DO NOT CAST. eager loading shows error
		//'status_code'			=> LandlordAccountStatusEnum::class,
	];

	/* ---------------- Scope ---------------------- */
	/**
	 * Scope a query to only include current users account.
	 */
	public function scopeByAccount(Builder $query): void
	{
		$query->where('id', auth()->user()->account_id);
	}

	public function scopeByUser(Builder $query): void
	{
		$query->where('owner_id', auth()->user()->id);
	}

	/* ---------------- HasMany ---------------------- */
	public function accountservicess(): HasMany
	{
		return $this->hasMany(AccountService::class);
	}


	/* ---------------- belongsTo ---------------------- */
	public function relCountry()
	{
		return $this->belongsTo(Country::class, 'country');
	}

	public function owner()
	{
		return $this->belongsTo(User::class, 'owner_id');
	}
	public function service()
	{
		return $this->belongsTo(Service::class, 'service_id');
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
