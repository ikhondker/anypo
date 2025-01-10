<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class Export extends Model
{
	use HasFactory;
	use AddCreatedUpdatedBy;

	protected $primaryKey 	= 'entity';
	public $incrementing 	= false;
	protected $keyType		= 'string';

	protected $fillable = [
		'entity', 'name', 'access', 'article_id', 'article_id_required', 'start_date', 'end_date', 'currency', 'supplier_id', 'supplier_id_required', 'project_id', 'project_id_required', 'dept_id', 'dept_id_required', 'user_id', 'user_id_required', 'warehouse_id', 'warehouse_id_required', 'bank_account_id', 'bank_account_id_required', 'category_id', 'category_id_required', 'item_id', 'item_id_required', 'order_by1', 'order_by2', 'run_count', 'enable', 'updated_by', 'updated_at',
	];

}
