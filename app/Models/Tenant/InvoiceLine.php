<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;



class InvoiceLine extends Model
{
    use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'invoice_id', 'line_num', 'summary', 'qty', 'price', 'sub_total', 'tax', 'gst', 'amount', 'fc_sub_total', 'fc_tax', 'fc_gst', 'fc_amount', 'notes', 'error_code', 'closure_status', 'updated_by', 'updated_at',

	];
}
