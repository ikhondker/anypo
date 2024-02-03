<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* IQBAL 21-OCT-22 */
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;


class Invoice extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'budget_id', 'dept_id', 'amount', 'amount_pr_booked', 'amount_pr_issued', 'amount_po_booked', 'amount_po_issued', 'amount_grs', 'amount_payment', 'end_date', 'notes', 'freeze', 'updated_by', 'updated_at',
	];

	/* ----------------- Scopes ------------------------- */
	/**
	 * Scope a query to return all payment of PO's where he is the buyer.
	*/
	public function scopeByPoBuyer(Builder $query, $id): void
	{
		// TODO
		//if (! $id) return;

		$query->whereHas('po', function ($q) use ($id) {
			$q->where('buyer_id', $id);
        });

	}

	/**
	 *  Scope a query to return all payment of PO's of his dept.
	*/
	public function scopeByPoDept(Builder $query,$id): void
	{
		$query->whereHas('po', function ($q) use ($id) {
			$q->where('dept_id', $id);
        });

	}

	/* ----------------- Functions ---------------------- */


	/* ---------------- belongsTo ---------------------- */
	/* ----------------- HasMany ------------------------ */


	/* ---------------- belongsTo ---------------------- */
	public function po(){
		return $this->belongsTo(Po::class,'po_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}
	public function creator(){
		return $this->belongsTo(User::class,'creator_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}
}
