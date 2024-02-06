<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* IQBAL 21-OCT-22 */
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;
use App\Models\Tenant\Budget;
use App\Models\Tenant\Lookup\Dept;

class Dbu extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'dept_budget_id', 'entity', 'article_id', 'event', 'amount_pr_booked', 'amount_pr_issued', 'amount_po_booked', 'amount_po_issued', 'amount_grs', 'amount_payment', 'updated_by', 'updated_at',
	];


	/* ---------------- belongsTo ---------------------- */
	public function dept_budget(){
		return $this->belongsTo(DeptBudget::class,'dept_budget_id');
	}
}
