<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* IQBAL 21-OCT-22 */
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;


class Report extends Model
{
	use HasFactory;
	use AddCreatedUpdatedBy;

	protected $fillable = [
		'name', 'title', 'access', 'article_id', 'start_date', 'end_date', 'user_id', 'item_id', 'supplier_id', 'project_id', 'category_id', 'dept_id', 'warehouse_id','order_by', 'enable', 'updated_by', 'updated_at',
	];
}
