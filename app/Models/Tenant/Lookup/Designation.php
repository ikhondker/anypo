<?php

namespace App\Models\Tenant\Lookup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/* IQBAL 21-OCT-22 */
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;

class Designation extends Model
{
    use HasFactory, AddCreatedUpdatedBy;

    protected $fillable = [
        'name','enable','updated_at','updated_by'
   ];
   
    /* ----------------- Functions ---------------------- */
    public static function getAll() {
        return  Designation::select('id','name')
          ->where('enable', true)
          ->orderBy('id','asc')
          ->get();
    }

    /* ----------------- Scopes ------------------------- */
    /**
     * Scope a query to only  non-seeded users.
     */
    public function scopePrimary(Builder $query): void
    {
        $query->where('enable', true);
    }

    /* ----------------- HasMany ------------------------ */

    /* ----------------- HasMany ------------------------ */
    public function user_title() {
        return $this->hasMany(User::class);
    }

    /* ---------------- belongsTo ---------------------- */

}
