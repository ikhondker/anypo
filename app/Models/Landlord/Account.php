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

use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;

use App\Models\Landlord\Lookup\Country;
use App\Models\Landlord\Manage\Status;
use App\Models\Landlord\Lookup\Product;

use App\Enum\Landlord\AccountStatusEnum;

class Account extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'site', 'tenant_id', 'name', 'currency', 'tagline', 'address1', 'address2', 'city', 'state', 'zip', 'country', 'website', 'facebook', 'linkedin', 'email', 'cell', 'owner_id', 'primary_product_id', 'logo', 'base_mnth', 'base_user', 'base_gb', 'base_price', 'mnth', 'user', 'gb', 'monthly_fee', 'monthly_addon', 'price', 'discount', 'discount_date', 'discount_by', 'start_date', 'end_date', 'next_bill_generated', 'next_invoice_no', 'last_bill_date', 'expired_at', 'banner_show', 'banner_message', 'maintenance', 'notes_internal', 'landlord_total_paid', 'landlord_count_user', 'landlord_count_product', 'tenant_count_user', 'tenant_used_gb', 'tenant_count_pr', 'tenant_count_po', 'tenant_count_grs', 'tenant_count_inv', 'tenant_count_pay', 'tenant_enable', 'rank', 'status_code', 'updated_by', 'updated_at',
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
		//'status_code'			=> AccountStatusEnum::class,
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
	// public function accountservicess(): HasMany
	// {
	// 	return $this->hasMany(AccountService::class);
	// }


	/* ---------------- belongsTo ---------------------- */
	public function relCountry()
	{
		return $this->belongsTo(Country::class, 'country');
	}

	public function owner()
	{
		return $this->belongsTo(User::class, 'owner_id');
	}

	public function primaryProduct()
	{
		return $this->belongsTo(Product::class,'primary_product_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}

	// public function service()
	// {
	// 	return $this->belongsTo(Service::class, 'service_id');
	// }
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
