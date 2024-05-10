<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Tenant\Manage\Status;

class StatusSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{

		// Primary Secondary Success Danger Warning Info
		// bg-soft-primary
		$statuses =  [
			[
				'code' 				=> 'draft',
				'name' 				=> 'Draft',
				'badge' 			=> 'bg-info',
		  	],
			[
				'code' 				=> 'partial',
				'name' 				=> 'Partial',
				'badge' 			=> 'bg-info',
		  	],
			[
				'code' 				=> 'accounted',
				'name' 				=> 'Accounted',
				'badge' 			=> 'bg-success',
		  	],
			[
				'code' 				=> 'approved',
				'name' 				=> 'Approved',
				'badge' 			=> 'bg-success',
		  	],
			[
				'code' 				=> 'received',
				'name' 				=> 'Received',
				'badge' 			=> 'bg-success',
		  	],
			[
				'code' 				=> 'open',
				'name' 				=> 'Open',
				'badge' 			=> 'bg-success',
		  	],
			[
				'code' 				=> 'validated',
				'name' 				=> 'Validated',
				'badge' 			=> 'bg-success',
		  	],
			[
				'code' 				=> 'uploaded',
				'name' 				=> 'Uploaded',
				'badge' 			=> 'bg-success',
		  	],
		  	[
				'code' 				=> 'posted',
				'name' 				=> 'Posted',
				'badge' 			=> 'bg-success',
		  	],
			[
				'code' 				=> 'paid',
				'name' 				=> 'paid',
				'badge' 			=> 'bg-success',
		  	],
			[
				'code' 				=> 'submitted',
				'name' 				=> 'Submitted',
				'badge' 			=> 'bg-warning',
		  	],
			[
				'code' 				=> 'due',
				'name' 				=> 'Due',
				'badge' 			=> 'bg-warning',
		  	],

			[
				'code' 				=> 'unpaid',
				'name' 				=> 'Unpaid',
				'badge' 			=> 'bg-warning',
		  	],
			[
				'code' 				=> 'in-process',
				'name' 				=> 'In-Process',
				'badge' 			=> 'bg-warning',
		  	],
		  	[
				'code' 				=> 'rejected',
				'name' 				=> 'Rejected',
				'badge' 			=> 'bg-secondary',
		  	],
		  	[
				'code' 				=> 'closed',
				'name' 				=> 'closed',
				'badge' 			=> 'bg-secondary',
		  	],
		  	[
				'code' 				=> 'force-closed',
				'name' 				=> 'Force Closed',
				'badge' 			=> 'bg-secondary',
		  	],
		  	[
				'code' 				=> 'canceled',
				'name' 				=> 'Canceled',
				'badge' 			=> 'bg-danger',
		  	],
			[
				'code' 				=> 'error',
				'name' 				=> 'Error',
				'badge' 			=> 'bg-danger',
		  	],

		  ];
		//
		Status::insert($statuses);
	}
}
 