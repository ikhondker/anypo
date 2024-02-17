<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* IQBAL 21-OCT-22 */
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;

use App\Enum\ReceiptStatusEnum;

use App\Models\Tenant\Po;
use App\Models\Tenant\Pol;
use App\Models\Tenant\Lookup\Warehouse;

use App\Models\Tenant\Manage\Status;

use Illuminate\Database\Eloquent\Builder;

class Receipt extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'receive_date', 'rcv_type', 'pol_id', 'warehouse_id', 'receiver_id', 'qty', 'price', 'amount', 'fc_exchange_rate', 'fc_amount', 'dr_account', 'cr_account', 'notes', 'status', 'updated_by', 'updated_at',
	];


	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'updated_at'		=> 'datetime',
		'created_at'		=> 'datetime',
		'receive_date'		=> 'date',
		// DO NOT CAST. eager loading shows error
		//'status'			=> ReceiptStatusEnum::class
	];

	/* ----------------- Scopes ------------------------- */
	/**
	 * Scope a query to return all payment of PO's where he is the buyer.
	*/
	public function scopeByPoBuyer(Builder $query, $id): void
	{
		$query->with('pol')->whereHas('pol.po', function ($q) use ($id) {
			$q->where('buyer_id', $id);
        });
	}

	/**
	 *  Scope a query to return all payment of PO's of his dept.
	*/
	public function scopeByPoDept(Builder $query,$id): void
	{
		$query->with('pol')->whereHas('pol.po', function ($q) use ($id) {
			$q->where('dept_id', $id);
        });

	}
	
	/* ----------------- Functions ---------------------- */
	/* ----------------- HasMany ------------------------ */
	
	/* ---------------- belongsTo ---------------------- */

	public function status_badge(){
		return $this->belongsTo(Status::class,'status')->withDefault([
			'name' => '[ Empty ]',
		]);
	}

	public function pol(){
		return $this->belongsTo(Pol::class,'pol_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}
	public function receiver(){
		return $this->belongsTo(User::class,'receiver_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}
	public function warehouse(){
		return $this->belongsTo(Warehouse::class,'warehouse_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}

}
