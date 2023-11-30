<?php

namespace App\Models\Landlord;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


/* IQBAL 21-OCT-22 */
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;
use App\Models\Landlord\Invoice;
use App\Models\Landlord\Account;
use App\Models\Landlord\PaymentMethod;

use App\Models\Landlord\Admin\Status;

use App\Enum\LandlordPaymentStatusEnum;

class Payment extends Model
{
    use HasFactory, AddCreatedUpdatedBy;

    protected $fillable = [
        'summary', 'pay_date', 'invoice_id', 'account_id', 'owner_id', 'payment_method_id', 'amount', 'currency', 'cheque_no', 'payment_token', 'reference_id', 'notes', 'ip', 'status_code', 'updated_by', 'updated_at',
    ];

    protected $casts = [
        'pay_date'      => 'datetime',
        'updated_at'    => 'datetime',
        'created_at'    => 'datetime',
        'status_code'        => LandlordPaymentStatusEnum::class,
    ];

    // protected $dates = [
    //     'pay_date'
    // ];

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
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
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
