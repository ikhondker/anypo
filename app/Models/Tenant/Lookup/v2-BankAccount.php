<?php

namespace App\Models\Tenant\Lookup;

/* IQBAL 21-OCT-22 */
use App\Traits\AddCreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'name', 'pr_hierarchy_id', 'po_hierarchy_id', 'text_color', 'bg_color', 'icon', 'enable', 'updated_by', 'updated_at',
	];
}
