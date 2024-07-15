<?php

namespace App\Models\Tenant\Ae;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Support\Facades\Log;
use App\Traits\AddCreatedUpdatedBy;

class Ael extends Model
{
	use HasFactory;

	use AddCreatedUpdatedBy;

	protected $fillable = [
		'aeh_id', 'line_num', 'accounting_date', 'ac_code', 'line_description', 'fc_currency', 'fc_dr_amount', 'fc_cr_amount', 'reference_no', 'updated_by', 'updated_at',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'deleted_at'	=> 'datetime',
		'updated_at'	=> 'datetime',
		'created_at'	=> 'datetime',
	];


	/* ----------------- HasMany ------------------------ */


	/* ---------------- belongsTo ---------------------- */
    public function aeh(){
		return $this->belongsTo(Aeh::class,'aeh_id');
	}

}
