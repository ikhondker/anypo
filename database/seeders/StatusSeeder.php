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
				'badge' 			=> 'info',
				'icon'				=> 'user-cog',
			],
			[
				'code' 				=> 'partial',
				'name' 				=> 'Partial',
				'badge' 			=> 'info',
				'icon'				=> 'user-cog',
			],
			[
				'code' 				=> 'accounted',
				'name' 				=> 'Accounted',
				'badge' 			=> 'success',
				'icon'				=> 'book-user',
			],
			[
				'code' 				=> 'approved',
				'name' 				=> 'Approved',
				'badge' 			=> 'success',
				'icon'				=> 'shield-check',
			],
			[
				'code' 				=> 'received',
				'name' 				=> 'Received',
				'badge' 			=> 'success',
				'icon'				=> 'thumbs-up',
			],
			[
				'code' 				=> 'open',
				'name' 				=> 'Open',
				'badge' 			=> 'success',
				'icon'				=> 'folder-open',
			],
			[
				'code' 				=> 'validated',
				'name' 				=> 'Validated',
				'badge' 			=> 'success',
				'icon'				=> 'search-check',
			],
			[
				'code' 				=> 'uploaded',
				'name' 				=> 'Uploaded',
				'badge' 			=> 'success',
				'icon'				=> 'folder-up',
			],
			[
				'code' 				=> 'posted',
				'name' 				=> 'Posted',
				'badge' 			=> 'success',
				'icon'				=> 'shield-check',
			],
			[
				'code' 				=> 'paid',
				'name' 				=> 'paid',
				'badge' 			=> 'success',
				'icon'				=> 'circle-dollar-sign',
			],
			[
				'code' 				=> 'submitted',
				'name' 				=> 'Submitted',
				'badge' 			=> 'success',
				'icon'				=> 'cog',
			],
			[
				'code' 				=> 'due',
				'name' 				=> 'Due',
				'badge' 			=> 'warning',
				'icon'				=> 'user-round-cog',
			],
			[
				'code' 				=> 'unpaid',
				'name' 				=> 'Unpaid',
				'badge' 			=> 'warning',
				'icon'				=> 'receipt',
			],
			[
				'code' 				=> 'in-process',
				'name' 				=> 'In-Process',
				'badge' 			=> 'warning',
				'icon'				=> 'user-cog',
			],
			[
				'code' 				=> 'closed',
				'name' 				=> 'closed',
				'badge' 			=> 'secondary',
				'icon'				=> 'shield-check',
			],
			[
				'code' 				=> 'pending',
				'name' 				=> 'pending',
				'badge' 			=> 'secondary',
				'icon'				=> 'circle-gauge',
			],
			[
				'code' 				=> 'force-closed',
				'name' 				=> 'Force Closed',
				'badge' 			=> 'secondary',
				'icon'				=> 'shield-check',
			],
			[
				'code' 				=> 'rejected',
				'name' 				=> 'Rejected',
				'badge' 			=> 'danger',
				'icon'				=> 'book-x',
			],
			[
				'code' 				=> 'canceled',
				'name' 				=> 'Canceled',
				'badge' 			=> 'danger',
				'icon'				=> 'circle-x',
			],
			[
				'code' 				=> 'error',
				'name' 				=> 'Error',
				'badge' 			=> 'danger',
				'icon'				=> 'triangle-alert',
			],

		];
		//
		Status::insert($statuses);
	}
}
