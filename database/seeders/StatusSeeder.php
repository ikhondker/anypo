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
		$statuses = [
			[
				'code' 				=> 'draft',
				'name' 				=> 'Draft',
				'badge' 			=> 'badge-subtle-info',
			],
			[
				'code' 				=> 'partial',
				'name' 				=> 'Partial',
				'badge' 			=> 'badge-subtle-info',
			],
			[
				'code' 				=> 'accounted',
				'name' 				=> 'Accounted',
				'badge' 			=> 'badge-subtle-success',
			],
			[
				'code' 				=> 'approved',
				'name' 				=> 'Approved',
				'badge' 			=> 'badge-subtle-success',
			],
			[
				'code' 				=> 'received',
				'name' 				=> 'Received',
				'badge' 			=> 'badge-subtle-success',
			],
			[
				'code' 				=> 'open',
				'name' 				=> 'Open',
				'badge' 			=> 'badge-subtle-success',
			],
			[
				'code' 				=> 'validated',
				'name' 				=> 'Validated',
				'badge' 			=> 'badge-subtle-success',
			],
			[
				'code' 				=> 'uploaded',
				'name' 				=> 'Uploaded',
				'badge' 			=> 'badge-subtle-success',
			],
			[
				'code' 				=> 'posted',
				'name' 				=> 'Posted',
				'badge' 			=> 'badge-subtle-success',
			],
			[
				'code' 				=> 'paid',
				'name' 				=> 'paid',
				'badge' 			=> 'badge-subtle-success',
			],
			[
				'code' 				=> 'submitted',
				'name' 				=> 'Submitted',
				'badge' 			=> 'badge-subtle-success',
			],
			[
				'code' 				=> 'due',
				'name' 				=> 'Due',
				'badge' 			=> 'badge-subtle-warning',
			],
			[
				'code' 				=> 'unpaid',
				'name' 				=> 'Unpaid',
				'badge' 			=> 'badge-subtle-warning',
			],
			[
				'code' 				=> 'in-process',
				'name' 				=> 'In-Process',
				'badge' 			=> 'badge-subtle-warning',
			],

			[
				'code' 				=> 'closed',
				'name' 				=> 'closed',
				'badge' 			=> 'badge-subtle-secondary',
			],
			[
				'code' 				=> 'pending',
				'name' 				=> 'pending',
				'badge' 			=> 'badge-subtle-secondary',
			],
			[
				'code' 				=> 'force-closed',
				'name' 				=> 'Force Closed',
				'badge' 			=> 'badge-subtle-secondary',
			],
			[
				'code' 				=> 'rejected',
				'name' 				=> 'Rejected',
				'badge' 			=> 'badge-subtle-danger',
			],
			[
				'code' 				=> 'canceled',
				'name' 				=> 'Canceled',
				'badge' 			=> 'badge-subtle-danger',
			],
			[
				'code' 				=> 'error',
				'name' 				=> 'Error',
				'badge' 			=> 'badge-subtle-danger',
			],

		];
		//
		Status::insert($statuses);
	}
}
