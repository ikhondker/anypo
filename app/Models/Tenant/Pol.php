<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;
use App\Models\Tenant\Lookup\Item;
use App\Models\Tenant\Lookup\Uom;
use App\Models\Tenant\Po;
use Illuminate\Database\Eloquent\Builder;

use App\Models\Tenant\Manage\Status;
use App\Enum\ClosureStatusEnum;
use App\Enum\AuthStatusEnum;

class Pol extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'po_id', 'line_num', 'item_id', 'item_description', 'uom_id', 'qty', 'price', 'sub_total', 'tax_pc', 'gst_pc', 'tax', 'gst', 'amount', 'grs_price', 'fc_sub_total', 'fc_tax', 'fc_gst', 'fc_amount', 'fc_grs_price', 'notes', 'error_code', 'requestor_id', 'dept_id', 'unit_id', 'project_id', 'prl_id', 'received_qty', 'closure_status', 'asset_created', 'asset_date', 'updated_by', 'updated_at',
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

	/* ----------------- Scopes ------------------------- */
	/**
	 * Scope a query to only All Approved PR for tenant.
	*/
	public function scopexxReceiptDue(Builder $query): void
	{
		//TODO
		$query->where('closure_status',ClosureStatusEnum::OPEN->value);
		//->where('received_qty','<','qty');
	}

	/**
	 * Scope a query to return all payment of PO's where he is the buyer.
	*/
	public function scopeReceiptDue(Builder $query): void
	{
		// P2
		//if (! $id) return;
		$query->where('closure_status',ClosureStatusEnum::OPEN->value)
			->whereHas('po', function ($q) {
				$q->where('auth_status',AuthStatusEnum::APPROVED->value);
			});
	}


	/* ----------------- Functions ---------------------- */

	/* ----------------- HasMany ------------------------ */

	/* ---------------- belongsTo ---------------------- */
	public function close_status_badge(){
		return $this->belongsTo(Status::class,'closure_status')->withDefault([
			'name' => '[ Empty ]',
		]);
	}

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
