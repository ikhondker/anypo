<?php

namespace App\Models\Landlord\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* IQBAL 21-OCT-22 */
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;

class Country extends Model
{

    use HasFactory, AddCreatedUpdatedBy;
    protected $primaryKey = 'country';
    protected $keyType = 'string';

    protected $fillable = [
        'name', 'enable', 'updated_at', 'updated_by'
    ];

    public static function getAll()
    {
        return  Country::select('country', 'name')
            ->where('enable', true)
            ->orderBy('name', 'asc')
            ->get();
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
