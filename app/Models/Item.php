<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* IQBAL 21-OCT-22 */
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;


class Item extends Model
{
    use HasFactory, AddCreatedUpdatedBy;

    protected $fillable = [
        'name', 'notes', 'code', 'sku', 'category_id', 'oem_id', 'uom_id', 'gl_type', 'price', 'stock', 'reorder', 'photo', 'enable', 'updated_by', 'updated_at',
    ];

    /* ----------------- Functions ---------------------- */
    public static function getAll() {
        return  Item::select('id', 'name')
            ->where('enable', true)
            ->orderBy('id', 'asc')
            ->get();
    }

    
    /* ----------------- HasMany ------------------------ */
    public function prl() {
        return $this->hasMany(Prl::class);
    }

    public function pol() {
        return $this->hasMany(Pol::class);
    }

    /* ---------------- belongsTo ---------------------- */
    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function oem(){
        return $this->belongsTo(Oem::class,'oem_id');
    }

    public function uom(){
        return $this->belongsTo(Uom::class,'uom_id');
    }
    public function relGlType(){
        return $this->belongsTo(GlType::class,'gl_type');
    }

}
