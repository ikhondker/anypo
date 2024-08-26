<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;


class InvoiceLines extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'inv_id', 'line_num', 'summary', 'item_id', 'uom_id', 'qty', 'price', 'sub_total', 'tax', 'gst', 'amount', 'fc_sub_total', 'fc_tax', 'fc_gst', 'fc_amount', 'notes', 'error_code', 'closure_status', 'updated_by', 'updated_at',
	];
}
