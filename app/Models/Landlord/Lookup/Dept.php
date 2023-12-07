<?php

namespace App\Models\Landlord\Lookup;;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* IQBAL 21-OCT-22 */
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;
use App\Models\Landlord\Ticket;


class Dept extends Model
{
    use HasFactory, AddCreatedUpdatedBy;

    protected $fillable = [
        'name', 'enable', 'updated_at', 'updated_by'
    ];


    public static function getAll()
    {
        return  Dept::select('id', 'name')
            ->where('enable', true)
            ->orderBy('id', 'asc')
            ->get();
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function user_created_by()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function user_updated_by()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
