<?php

namespace App\Models\Tenant\Ae;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Support\Facades\Log;
use App\Traits\AddCreatedUpdatedBy;

use App\Enum\EntityEnum;

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

	/* ----------------- Scopes ------------------------- */
	/**
	 *  Scope a query to return all payment of PO's of his dept.
	*/
	public function scopeByPo(Builder $query,$id): void
	{
		$query->whereHas('aeh', function ($q) use ($id) {
			$q->where('po_id', $id);
		});
	}


	/**
	 *  Scope a query to return all payment of PO's of his dept.
	*/
	public function scopeByReceipt(Builder $query,$id): void
	{
		$query->whereHas('aeh', function ($q) use ($id) {
			$q->where('source_entity', EntityEnum::RECEIPT->value)
			->where('article_id', $id);
		});
	}

	/**
	 *  Scope a query to return all payment of PO's of his dept.
	*/
	public function scopeByInvoice(Builder $query,$id): void
	{
		$query->whereHas('aeh', function ($q) use ($id) {
			$q->where('source_entity', EntityEnum::INVOICE->value)
			->where('article_id', $id);
		});
	}


	/**
	 *  Scope a query to return all payment of PO's of his dept.
	*/
	public function scopeByPayment(Builder $query,$id): void
	{
		$query->whereHas('aeh', function ($q) use ($id) {
			$q->where('source_entity', EntityEnum::PAYMENT->value)
			->where('article_id', $id);
		});
	}

	/**
	 *  Scope a query to return all payment of PO's of his dept.
	*/
	public function scopeByAeh(Builder $query,$id): void
	{
		$query->whereHas('aeh', function ($q) use ($id) {
			$q->where('id', $id);
		});
	}

	/* ----------------- HasMany ------------------------ */


	/* ---------------- belongsTo ---------------------- */
	public function aeh(){
		return $this->belongsTo(Aeh::class,'aeh_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}
}
