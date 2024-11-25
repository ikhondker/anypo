<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			Product.php
* @brief		This file contains the implementation of the Product
* @path			\app\Models\Landlord\Lookup
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
namespace App\Models\Landlord\Lookup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;
use App\Models\Landlord\Manage\Checkouts;
use App\Models\Landlord\Account;

use App\Enum\ServiceStatusEnum;

class Product extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'name', 'sub_name', 'sku', 'is_addon', 'addon_type', 'mnth', 'user', 'gb', 'price', 'old_price', 'price_3', 'price_6', 'price_12', 'price_24', 'subtotal', 'tax', 'vat', 'amount', 'notes', 'sold_qty', 'enable', 'photo', 'updated_by', 'updated_at',
	];

	protected $casts = [
		'start_date'	=> 'datetime',
		'end_date'		=> 'datetime',
		'updated_at'	=> 'datetime',
		'created_at'	=> 'datetime',
	];


	/* ---------------- HasMany ---------------------- */
	public function checkouts(): HasMany
	{
		return $this->hasMany(Checkouts::class);
	}
	public function accounts(): HasMany
	{
		return $this->hasMany(Account::class, 'primary_product_id');
	}

	public function services(): HasMany
	{
		return $this->hasMany(Service::class);
	}

	/* ---------------- belongsTo ---------------------- */

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
