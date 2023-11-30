<?php

namespace App\Models\Landlord\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* IQBAL 12-FEB-23 */
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;
use App\Models\Landlord\Checkouts;
use App\Models\Landlord\Account;

use App\Enum\ServiceStatusEnum;

class Product extends Model
{
    use HasFactory, AddCreatedUpdatedBy;

    protected $fillable = [
        'name', 'sub_name', 'sku', 'is_addon', 'addon_type', 'mnth', 'user', 'gb', 'price', 'old_price', 'price_3', 'price_6', 'price_12', 'price_24', 'subtotal', 'tax', 'vat', 'amount', 'notes', 'sold_qty', 'enable', 'photo', 'updated_by', 'updated_at',
    ];

    protected $casts = [
        'start_date'    => 'datetime',
        'end_date'      => 'datetime',
        'updated_at'    => 'datetime',
        'created_at'    => 'datetime',
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
