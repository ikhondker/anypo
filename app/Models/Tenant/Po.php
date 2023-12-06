<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* IQBAL 21-OCT-22 */
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;
use App\Models\Currency;

class Po extends Model
{
    use HasFactory;
    use AddCreatedUpdatedBy;

    protected $fillable = [
        'name','enable','updated_at','updated_by'
    ];
    /* ----------------- Functions ---------------------- */
    /* ----------------- HasMany ------------------------ */
    /* ---------------- belongsTo ---------------------- */
    public function relCurrency()
    {
        return $this->belongsTo(Currency::class, 'currency');
    }

}
