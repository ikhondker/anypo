<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Support\Facades\Log;
use App\Traits\AddCreatedUpdatedBy;

use App\Enum\EntityEnum;
use App\Enum\AccountingEvent;

class Accounting extends Model
{
    use HasFactory;
    
	use AddCreatedUpdatedBy;

	protected $fillable = [
		'source', 'entity', 'event', 'accounting_date', 'ac_code', 'line_description', 'fc_currency', 'fc_dr_amount', 'fc_cr_amount', 'po_id', 'article_id', 'reference_no', 'updated_by', 'updated_at',
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
		'entity'		=> EntityEnum::class,
		'event'			=> AccountingEvent::class,
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

    /* ----------------- HasMany ------------------------ */


	/* ---------------- belongsTo ---------------------- */
	public function po(){
		return $this->belongsTo(Po::class,'po_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}

}
