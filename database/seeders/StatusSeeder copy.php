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
                'icon'		        => 'user-cog',
			],
			[
				'code' 				=> 'partial',
				'name' 				=> 'Partial',
				'badge' 			=> 'badge-subtle-info',
                'icon'		        => 'user-cog',
			],
			[
				'code' 				=> 'accounted',
				'name' 				=> 'Accounted',
				'badge' 			=> 'badge-subtle-success',
                'icon'		        => 'book-user',
			],
			[
				'code' 				=> 'approved',
				'name' 				=> 'Approved',
				'badge' 			=> 'badge-subtle-success',
                'icon'		        => 'shield-check',
			],
			[
				'code' 				=> 'received',
				'name' 				=> 'Received',
				'badge' 			=> 'badge-subtle-success',
                'icon'		        => 'user-cog',
			],
			[
				'code' 				=> 'open',
				'name' 				=> 'Open',
				'badge' 			=> 'badge-subtle-success',
                'icon'		        => 'user-cog',
			],
			[
				'code' 				=> 'validated',
				'name' 				=> 'Validated',
				'badge' 			=> 'badge-subtle-success',
                'icon'		        => 'user-cog',
			],
			[
				'code' 				=> 'uploaded',
				'name' 				=> 'Uploaded',
				'badge' 			=> 'badge-subtle-success',
                'icon'		        => 'user-cog',
			],
			[
				'code' 				=> 'posted',
				'name' 				=> 'Posted',
				'badge' 			=> 'badge-subtle-success',
                'icon'		        => 'user-cog',
			],
			[
				'code' 				=> 'paid',
				'name' 				=> 'paid',
				'badge' 			=> 'badge-subtle-success',
                'icon'		        => 'user-cog',
			],
			[
				'code' 				=> 'submitted',
				'name' 				=> 'Submitted',
				'badge' 			=> 'badge-subtle-success',
                'icon'		        => 'user-cog',
			],
			[
				'code' 				=> 'due',
				'name' 				=> 'Due',
				'badge' 			=> 'badge-subtle-warning',
                'icon'		        => 'user-cog',
			],
			[
				'code' 				=> 'unpaid',
				'name' 				=> 'Unpaid',
				'badge' 			=> 'badge-subtle-warning',
                'icon'		        => 'user-cog',
			],
			[
				'code' 				=> 'in-process',
				'name' 				=> 'In-Process',
				'badge' 			=> 'badge-subtle-warning',
                'icon'		        => 'user-cog',
			],

			[
				'code' 				=> 'closed',
				'name' 				=> 'closed',
				'badge' 			=> 'badge-subtle-secondary',
                'icon'		        => 'user-cog',
			],
			[
				'code' 				=> 'pending',
				'name' 				=> 'pending',
				'badge' 			=> 'badge-subtle-secondary',
                'icon'		        => 'user-cog',
			],
			[
				'code' 				=> 'force-closed',
				'name' 				=> 'Force Closed',
				'badge' 			=> 'badge-subtle-secondary',
                'icon'		        => 'user-cog',
			],
			[
				'code' 				=> 'rejected',
				'name' 				=> 'Rejected',
				'badge' 			=> 'badge-subtle-danger',
                'icon'		        => 'user-cog',
			],
			[
				'code' 				=> 'canceled',
				'name' 				=> 'Canceled',
				'badge' 			=> 'badge-subtle-danger',
                'icon'		        => 'user-cog',
			],
			[
				'code' 				=> 'error',
				'name' 				=> 'Error',
				'badge' 			=> 'badge-subtle-danger',
                'icon'		        => 'user-cog',
			],

		];
		//
		Status::insert($statuses);
	}
}
