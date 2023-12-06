<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    protected $fillable = [
        'type', 'notifiable_type', 'notifiable_id', 'data', 'read_at', 'updated_at',
    ];


    // NOTES: https://stackoverflow.com/questions/61844701/laravel-how-to-get-id-of-database-notification
    // protected $casts = [
    //     'data' => 'array',
    //     'id' => 'string'
    // ];

    protected $casts = [
        'data'      => 'array',
        'id'        => 'string',
    ];
}
