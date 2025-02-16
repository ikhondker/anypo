<?php

namespace App\Models\Tenant\Lookup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;

use Illuminate\Database\Eloquent\Builder;

class Project extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'code', 'name', 'dept_id', 'pm_id', 'start_date', 'end_date', 'budget_control', 'amount', 'amount_pr_booked', 'amount_pr', 'amount_po_booked', 'amount_po_tax', 'amount_po_gst', 'amount_po', 'amount_grs', 'amount_invoice', 'amount_payment', 'count_pr_booked', 'count_pr', 'count_po_booked', 'count_po', 'count_grs', 'count_invoice', 'count_payment', 'notes', 'bg_color', 'icon', 'closed', 'updated_by', 'updated_at',
	];

	/* ----------------- Scopes ------------------------- */
	/**
	 * Scope a query to only  non-seeded users.
	 */
	public function scopePrimary(Builder $query): void
	{
		$query->where('closed', false)->orderBy('name', 'asc');
	}

	/* ----------------- Functions ---------------------- */

	/* ----------------- HasMany ------------------------ */
	public function prs(): HasMany
	{
		return $this->hasMany(Pr::class, 'project_id');
	}

	/* ---------------- belongsTo ---------------------- */
	public function pm() {
		return $this->belongsTo(User::class,'pm_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}

	public function dept() {
		return $this->belongsTo(Dept::class,'dept_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}


}
