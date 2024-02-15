<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* IQBAL 21-OCT-22 */
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;
use App\Models\Tenant\Lookup\Item;
use App\Models\Tenant\Lookup\Uom;
use App\Models\Tenant\Po;
use Illuminate\Database\Eloquent\Builder;

use App\Enum\ClosureStatusEnum;

class Pol extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'po_id', 'line_num', 'summary', 'item_id', 'uom_id', 'qty', 'price', 'sub_total', 'tax', 'gst', 'amount', 'fc_sub_total', 'fc_tax', 'fc_gst', 'fc_amount', 'notes', 'requestor_id', 'dept_id', 'unit_id', 'project_id', 'prl_id', 'received_qty', 'closure_status', 'asset_created', 'asset_date', 'updated_by', 'updated_at',
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

	/* ----------------- Functions ---------------------- */
	/* ----------------- HasMany ------------------------ */
	/* ---------------- belongsTo ---------------------- */
	/* ---------------- belongsTo ---------------------- */
	public function po(){
		return $this->belongsTo(Po::class,'po_id');
	}

	public function item(){
		return $this->belongsTo(Item::class,'item_id');
	}

	public function uom(){
		return $this->belongsTo(Uom::class,'uom_id');
	}
}
