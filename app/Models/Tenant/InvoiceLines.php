<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* IQBAL 21-OCT-22 */
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;


class InvoiceLines extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'budget_id', 'dept_id', 'amount', 'amount_pr_booked', 'amount_pr_issued', 'amount_po_booked', 'amount_po_issued', 'amount_grs', 'amount_payment', 'end_date', 'notes', 'freeze', 'updated_by', 'updated_at',
	];
}
