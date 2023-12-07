<?php

namespace App\Models\Landlord\Lookup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// IQBAL 27-SEP-22
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;

class Status extends Model
{
    use HasFactory, AddCreatedUpdatedBy;

    protected $primaryKey   = 'code';
    protected $keyType      = 'string';

    protected $fillable = [
        'name', 'badge', 'icon', 'accounts', 'tickets', 'checkouts', 'invoices', 'payments', 'notify_user', 'email_user', 'enable', 'updated_by', 'updated_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'updated_at'        => 'datetime',
        'created_at'        => 'datetime',
    ];
}
