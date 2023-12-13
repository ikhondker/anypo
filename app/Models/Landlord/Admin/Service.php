<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			Service.php
* @brief		This file contains the implementation of the Service
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
namespace App\Models\Landlord\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/* IQBAL 12-FEB-23 */
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;
use App\Models\Landlord\Checkouts;
use App\Models\Landlord\Account;

use App\Models\Landlord\Lookup\Product;

use App\Enum\ServiceStatusEnum;

class Service extends Model
{
    use HasFactory, AddCreatedUpdatedBy;

    protected $fillable = [
        'name', 'account_id', 'product_id', 'owner_id', 'is_addon', 'addon_type', 'mnth', 'user', 'gb', 'price', 'subtotal', 'tax', 'vat', 'amount', 'start_date', 'end_date', 'enable', 'notes', 'updated_by', 'updated_at',
    ];

    protected $casts = [
        'updated_at'    => 'datetime',
        'created_at'    => 'datetime',
    ];



    /* ---------------- Scope ---------------------- */

    /**
     * Scope a query to only include current users account.
     */
    public function scopeByAccount(Builder $query): void
    {
        $query->where('account_id', auth()->user()->account_id);
    }

    public function scopeByUser(Builder $query): void
    {
        $query->where('owner_id', auth()->user()->id);
    }
    
    /* ---------------- HasMany ---------------------- */



    /* ---------------- belongsTo ---------------------- */
    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
