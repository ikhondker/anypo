<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* IQBAL 21-OCT-22 */
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;
use App\Models\Tenant\Lookup\Item;
use App\Models\Tenant\Pr;
use Illuminate\Database\Eloquent\Builder;

use App\Enum\PrStatusEnum;

class Prl extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'pr_id', 'line_num', 'summary', 'item_id', 'notes', 'qty', 'price', 'sub_total', 'tax', 'vat', 'amount', 'received_qty', 'status', 'updated_by', 'updated_at',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'updated_at'	=> 'datetime',
		'created_at'	=> 'datetime',
		'status'		=> PrStatusEnum::class,
	];

	/**
	 * Scope a query to only  non-seeded users.
	 */
	public function scopeBy_pr_id(Builder $query, $id): void
	{
		$query->where(true);
	}

	/* ----------------- Functions ---------------------- */

	public static function xxgetLinesByPrId($pr_id)
	{
		return Prl::select('id', 'name')
			->where('pr_id', $pr_id)
			->orderBy('id', 'asc')
			->get();
	}

	/* ----------------- HasMany ------------------------ */


	/* ---------------- belongsTo ---------------------- */
	public function pr(){
		return $this->belongsTo(Pr::class,'pr_id');
	}

	public function item(){
		return $this->belongsTo(Item::class,'item_id');
	}


}
