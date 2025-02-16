<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;
use App\Models\Tenant\Lookup\Item;
use App\Models\Tenant\Lookup\Uom;
use App\Models\Tenant\Pr;
use Illuminate\Database\Eloquent\Builder;

use App\Enum\Tenant\ClosureStatusEnum;

class Prl extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'pr_id', 'line_num', 'item_id', 'item_description', 'uom_id', 'qty', 'price', 'sub_total', 'tax_pc', 'gst_pc', 'tax', 'gst', 'amount', 'fc_sub_total', 'fc_tax', 'fc_gst', 'fc_amount', 'notes', 'error_code', 'closure_status', 'updated_by', 'updated_at',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'updated_at'		=> 'datetime',
		'created_at'		=> 'datetime',
		// DO NOT CAST. eager loading shows error
		// 'closure_status'	=> ClosureStatusEnum::class,
	];

	/**
	 * Scope a query to only  non-seeded users.
	 */
	public function scopeBy_pr_id(Builder $query, $id): void
	{
		$query->where(true);
	}

	/* ----------------- Functions ---------------------- */

	/* ----------------- HasMany ------------------------ */


	/* ---------------- belongsTo ---------------------- */
	public function pr(){
		return $this->belongsTo(Pr::class,'pr_id');
	}

	public function item(){
		return $this->belongsTo(Item::class,'item_id');
	}

	public function uom(){
		return $this->belongsTo(Uom::class,'uom_id');
	}

}
