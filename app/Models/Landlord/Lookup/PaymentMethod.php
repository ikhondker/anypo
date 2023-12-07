<?php

namespace App\Models\Landlord\Lookup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* IQBAL 12-FEB-23 */
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;
use App\Models\Landlord\Admin\Payment;


class PaymentMethod extends Model
{
    use HasFactory, AddCreatedUpdatedBy;

    protected $fillable = [
        'name', 'text_color', 'bg_color', 'icon', 'enable', 'updated_by', 'updated_at',
    ];

    protected $casts = [
        'updated_at'    => 'datetime',
        'created_at'    => 'datetime',
    ];

    /* ---------------- HasMany ---------------------- */
    public function payments()
    {
        return $this->hasMany(Payment::class);
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
