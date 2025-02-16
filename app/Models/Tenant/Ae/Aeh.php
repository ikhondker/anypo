<?php

namespace App\Models\Tenant\Ae;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Support\Facades\Log;
use App\Traits\AddCreatedUpdatedBy;

use App\Enum\EntityEnum;
use App\Enum\Tenant\AehEventEnum;


use App\Models\Tenant\Po;

class Aeh extends Model
{
	use HasFactory;

	use AddCreatedUpdatedBy;

	protected $fillable = [
		'accounting_date', 'source_app', 'source_entity', 'event', 'article_id', 'po_id', 'description', 'fc_currency', 'fc_dr_amount', 'fc_cr_amount', 'reference_no', 'status', 'updated_by', 'updated_at',
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
		'source_entity'	=> EntityEnum::class,
		'event'			=> AehEventEnum::class,
	];

	/* ----------------- Scopes ------------------------- */
	/**
	 * Scope a query to return all payment of PO's where he is the buyer.
	*/
	public function scopeByPo(Builder $query, $id): void
	{
		$query->whereHas('po', function ($q) use ($id) {
			$q->where('po_id', $id);
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

	/* ----------------- HasMany ------------------------ */
	public function aels() {
		return $this->hasMany(Ael::class);
	}

	/* ---------------- belongsTo ---------------------- */
	public function po(){
		return $this->belongsTo(Po::class,'po_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}
}
