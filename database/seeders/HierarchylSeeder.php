<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

use App\Models\Tenant\Workflow\Hierarchyl;

class HierarchylSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{

		// $admin = User::where('email', 'system@anypo.net')->firstOrFail();

		//Schema::disableForeignKeyConstraints();
		// Hierarchyl::truncate();
		//Schema::enableForeignKeyConstraints();

		// $hierarchyls = [
		// 		[
		// 			'hid'			=> 1001,
		// 			'approver_id'	=> $admin->id,
		// 		],
		// 		[
		// 			'hid'			=> 1002,
		// 			'approver_id'	=> $admin->id,
		// 		],
		// 	];

		// CreateTenant insert rows here
		// CreateTenant set approver_id as new admin id
		// Dont run this, as CreateTenant Jobs creates these lines
		// Hierarchyl::insert($hierarchyls);
	}
}
