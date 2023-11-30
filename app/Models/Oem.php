<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* IQBAL 21-OCT-22 */
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;

use Illuminate\Database\Eloquent\Builder;

class Oem extends Model
{
    use HasFactory, AddCreatedUpdatedBy;

    protected $fillable = [
        'name','enable','updated_at','updated_by'
    ];
   

    /* ----------------- Scopes ------------------------- */
    /**
     * Scope a query to only  non-seeded users.
     */
    public function scopePrimary(Builder $query): void
    {
        $query->where('enable', true);
    }

    /* ----------------- Functions ---------------------- */
    public static function getAll() {
        return  Oem::select('id','name')
          ->where('enable', true)
          ->orderBy('id','asc')
          ->get();
    }
   /* ----------------- HasMany ------------------------ */
   public function item(): HasMany
   {
       return $this->hasMany(Item::class, 'oem_id');
   }


   /* ---------------- belongsTo ---------------------- */

}
