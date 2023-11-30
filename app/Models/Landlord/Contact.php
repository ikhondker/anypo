<?php

namespace App\Models\Landlord;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;

use Notification;

//use App\Notifications\Contacted;


use App\Models\User;

class Contact extends Model
{
    use HasFactory, Notifiable;

    public $fillable = [
        'name', 'email', 'subject', 'message', 'owner_id', 'ip', 'user_id', 'contact_date'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'contact_date'     => 'datetime',
    ];

    /* ---------------- HasMany ---------------------- */


    /* ---------------- belongsTo ---------------------- */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /* ---------------- created and updated by ---------------------- */
}
