<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* IQBAL 21-OCT-22 */
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;
use App\Models\Hierarchy;

class Hierarchyl extends Model
{
    use HasFactory, AddCreatedUpdatedBy;

    protected $fillable = [
        'hid', 'sequence', 'approver_id', 'enable', 'updated_by', 'updated_at',
    ];
   
    /* ----------------- Functions ---------------------- */
    /* ----------------- HasMany ------------------------ */
    /* ---------------- belongsTo ---------------------- */
    public function hierarchy() { 
        return $this->belongsTo(Hierarchy::class); 
    }

    public function approver() { 
        return $this->belongsTo(User::class,'approver_id'); 
    }
}
