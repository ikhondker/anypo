<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// IQBAL 27-SEP-22
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;
use App\Models\Country;
use App\Models\Currency;

class Setup extends Model
{
    use HasFactory, AddCreatedUpdatedBy;

    protected $fillable = [
        'name', 'tagline', 'currency', 'freezed', 'tax', 'gst', 'address1', 'address2', 'city', 'state', 'zip', 'country', 'email', 'cell', 'website', 'facebook', 'linkedin', 'logo', 'show_notice', 'notice', 'admin_id', 'last_rate_date', 'maintenance', 'debug', 'enable', 'archive', 'purge', 'updated_by', 'updated_at',
   ];

   /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'last_rate_date'    => 'datetime',
        'updated_at'        => 'datetime',
        'created_at'        => 'datetime',
    ];




    /* ----------------- HasMany ------------------------ */

 
    /* ---------------- belongsTo ---------------------- */
    public function country_name(){
        return $this->belongsTo(Country::class,'country')->withDefault([
            'name' => '[ Empty ]',
        ]);
    }

    public function relCurrency(){
        return $this->belongsTo(Currency::class,'currency')->withDefault([
            'currency' => '[ Empty ]',
        ]);
    }

    public function admin_user(){
        return $this->belongsTo(User::class,'admin_id')->withDefault([
            'name' => '[ Empty ]',
        ]);
    }

    /* ---------------- created and updated by ---------------------- */
    public function user_created_by(){
        return $this->belongsTo(User::class,'created_by');
    }
    public function user_updated_by(){
        return $this->belongsTo(User::class,'updated_by');
    }
    
}
