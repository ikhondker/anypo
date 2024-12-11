<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;

use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;

class Tenant extends BaseTenant implements TenantWithDatabase
{
	use HasDatabase, HasDomains;

	//	protected $fillable = [
	// 	'start_date', 'end_date', 'initial_owner_id', 'initial_owner_name', 'initial_owner_email', 'initial_owner_tenant_password', 'user', 'gb', 'count_user', 'count_gb', 'count_pr', 'count_po', 'rank', 'status', 'updated_at', 'data',
	// ];

	protected $fillable = [
		'start_date', 'end_date', 'updated_at', 'data',
	];

}
