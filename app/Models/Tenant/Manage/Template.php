<?php

namespace App\Models\Tenant\Manage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* IQBAL 21-OCT-22 */
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;

class Template extends Model
{
    use HasFactory, AddCreatedUpdatedBy;
    // protected $dates = [
    //   'my_date', 
    // ];
    
    protected $casts = [ 
        'my_date_time'  =>'datetime',
        'my_date'       =>'datetime',
        'updated_at'    => 'datetime',
        'created_at'    => 'datetime',
    ];
    
    protected $fillable = [
      'code', 'name', 'summary', 'user_id', 'address1', 'address2', 'city', 'state', 'zip', 'country', 'email', 'phone', 'qty', 'amount', 'notes', 'enable', 'my_date', 'my_date_time', 'my_enum', 'my_url', 'logo', 'avatar', 'attachment', 'fbpage', 'updated_by', 'updated_at',
    ];

    /* ----------------- Functions ---------------------- */
    
    /* ----------------- Scopes ------------------------- */
    
    /* ----------------- HasMany ------------------------ */
    
    /* ----------------- belongsTo ---------------------- */
    public function user(){
      return $this->belongsTo(User::class,'user_id');
    }

    /* ---------------- created and updated by ---------------------- */
    public function user_created_by(){
      return $this->belongsTo(User::class,'created_by');
    }

    public function user_updated_by(){
      return $this->belongsTo(User::class,'updated_by');
    }

}
