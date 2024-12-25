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

}
