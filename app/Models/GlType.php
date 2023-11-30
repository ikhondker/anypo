<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/* IQBAL 21-OCT-22 */
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;

use Illuminate\Database\Eloquent\Builder;
class GlType extends Model
{
    use HasFactory, AddCreatedUpdatedBy;
    protected $primaryKey   = 'gl_type';
    protected $keyType      = 'string';

    protected $fillable = [
        'gl_type', 'name', 'enable', 'updated_by', 'updated_at',
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


     /* ----------------- Scopes ------------------------- */
    /**
     * Scope a query to only  non-seeded users.
     */
    public function scopePrimary(Builder $query): void
    {
        $query->where('enable', true);
    }


     /* ----------------- HasMany ------------------------ */
     public function items(): HasMany {
        return $this->hasMany(Item::class,'gl_type');
    }

    /* ---------------- belongsTo ---------------------- */
}
