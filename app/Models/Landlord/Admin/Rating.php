<?php

namespace App\Models\Landlord\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* IQBAL 12-FEB-23 */
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;


class Rating extends Model
{
    use HasFactory, AddCreatedUpdatedBy;

    protected $fillable = [
        'name', 'rating_scale', 'rating_area', 'text_color', 'bg_color', 'icon', 'enable', 'updated_by', 'updated_at',
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

    /* ---------------- HasMany ---------------------- */
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
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
