<?php

namespace App\Models\Landlord\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/* IQBAL 21-OCT-22 */
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;

class Activity extends Model
{
    use HasFactory, AddCreatedUpdatedBy;

    protected $fillable = [
        'account_id','object_name', 'object_id', 'event_name', 'column_name', 'prior_value', 'object_type', 'url', 'method', 'ip', 'role', 'message', 'user_id', 'updated_by', 'updated_at',
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


    /* ---------------- Scope ---------------------- */
    /**
     * Scope a query to only include current account users.
     */
    public function scopeByAccount(Builder $query): void
    {
        $query->where('account_id', auth()->user()->account_id);
    }

    /* ---------------- HasMany ---------------------- */


    /* ---------------- belongsTo ---------------------- */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault([
            'name' => '[ Guest ]',
        ]);
    }
}
