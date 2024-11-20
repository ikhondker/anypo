<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Tenant\Po;
use App\Models\Tenant\Lookup\Supplier;
use App\Models\Tenant\Lookup\Project;
use App\Models\Tenant\Lookup\Category;

use Faker\Generator;
use App\Models\User;

class PoSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$faker = app(Generator::class);
		$user1it = User::where('email', 'user1it@anypo.net')->firstOrFail();
		$user2it = User::where('email', 'user2it@anypo.net')->firstOrFail();
		$user1sales = User::where('email', 'user1sales@anypo.net')->firstOrFail();
		$user2sales = User::where('email', 'user2sales@anypo.net')->firstOrFail();

		$buyer1 = User::where('email', 'buyer1@anypo.net')->firstOrFail();
		$buyer2 = User::where('email', 'buyer2@anypo.net')->firstOrFail();

		$pos = [
				[
					'summary'			=> 'PO#1 for IT - BDT',
					'currency'			=> 'BDT',
					'requestor_id'		=> $user1it->id,
					'buyer_id'			=> $buyer1->id,
					'dept_id'			=> 1001,
					'supplier_id'		=> '1001',
					'project_id'		=> '1001',
                    'category_id'		=> Category::inRandomOrder()->first()->id,
					'notes'				=> $faker->paragraph,
					'sub_total'			=> 700,
					'tax'				=> 50,
					'gst'				=> 30,
					'amount'			=> 780,
					'fc_currency'		=> 'BDT',
				],
				[
					'summary'			=> 'PO#2 for IT - BDT',
					'currency'			=> 'BDT',
					'requestor_id'		=> $user1it->id,
					'buyer_id'			=> $buyer1->id,
					'dept_id'			=> 1001,
					'supplier_id'		=> '1001',
					'project_id'		=> '1001',
                    'category_id'		=> Category::inRandomOrder()->first()->id,
					'notes'				=> $faker->paragraph,
					'sub_total'			=> 800,
					'tax'				=> 50,
					'gst'				=> 30,
					'amount'			=> 880,
					'fc_currency'		=> 'BDT',
				],
				[
					'summary'			=> 'PO#3 for IT - USD',
					'currency'			=> 'USD',
					'requestor_id'		=> $user2it->id,
					'buyer_id'			=> $buyer1->id,
					'dept_id'			=> 1001,
					'supplier_id'		=> '1001',
					'project_id'		=> '1001',
                    'category_id'		=> Category::inRandomOrder()->first()->id,
					'notes'				=> $faker->paragraph,
					'sub_total'			=> 800,
					'tax'				=> 50,
					'gst'				=> 30,
					'amount'			=> 880,
					'fc_currency'		=> 'BDT',
				],
				[
					'summary'			=> 'PO#4 for Sales - BDT',
					'currency'			=> 'BDT',
					'requestor_id'		=> $user1sales->id,
					'buyer_id'			=> $buyer2->id,
					'dept_id'			=> 1005,
					'supplier_id'		=> '1002',
					'project_id'		=> '1002',
                    'category_id'		=> Category::inRandomOrder()->first()->id,
					'notes'				=> $faker->paragraph,
					'sub_total'			=> 500,
					'tax'				=> 50,
					'gst'				=> 30,
					'amount'			=> 580,
					'fc_currency'		=> 'BDT',
				],
				[
					'summary'			=> 'PO#5 for Sales - BDT',
					'currency'			=> 'BDT',
					'requestor_id'		=> $user1sales->id,
					'buyer_id'			=> $buyer2->id,
					'dept_id'			=> 1005,
					'supplier_id'		=> '1002',
					'project_id'		=> '1002',
                    'category_id'		=> Category::inRandomOrder()->first()->id,
					'notes'				=> $faker->paragraph,
					'sub_total'			=> 600,
					'tax'				=> 50,
					'gst'				=> 30,
					'amount'			=> 680,
					'fc_currency'		=> 'BDT',
				],
				[
					'summary'			=> 'PO#6 for Sales - USD',
					'currency'			=> 'USD',
					'requestor_id'		=> $user2sales->id,
					'buyer_id'			=> $buyer2->id,
					'dept_id'			=> 1005,
					'supplier_id'		=> '1002',
					'project_id'		=> '1002',
                    'category_id'		=> Category::inRandomOrder()->first()->id,
					'notes'				=> $faker->paragraph,
					'sub_total'			=> 600,
					'tax'				=> 50,
					'gst'				=> 30,
					'amount'			=> 680,
					'fc_currency'		=> 'BDT',
				],
			];

		Po::insert($pos);



	}
}
