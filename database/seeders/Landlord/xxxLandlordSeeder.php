<?php

namespace Database\Seeders\Landlord;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Landlord\Lookup\Rating;

class LandlordSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	/**
		 * Run the database seeds.
		 */
		public function run(): void
		{

		$this->call(\Database\Seeders\Landlord\UserSeeder::class);
		$this->call(\Database\Seeders\Landlord\MenuSeeder::class);
		$this->call(\Database\Seeders\Landlord\StatusSeeder::class);
		
		$this->call(\Database\Seeders\Landlord\EntitySeeder::class);
		// Make sure ConfigSeeder runs after UserSeeder as system_user_id will be generated
		$this->call(\Database\Seeders\Landlord\ConfigSeeder::class);

		$this->call(\Database\Seeders\Landlord\ContactSeeder::class);
		$this->call(\Database\Seeders\Landlord\CategorySeeder::class);
		$this->call(\Database\Seeders\Landlord\CountrySeeder::class);
		$this->call(\Database\Seeders\Landlord\DeptSeeder::class);
		$this->call(\Database\Seeders\Landlord\PrioritySeeder::class);

		$this->call(\Database\Seeders\Landlord\RatingSeeder::class);
		$this->call(\Database\Seeders\Landlord\PaymentMethodSeeder::class);
		$this->call(\Database\Seeders\Landlord\ProductSeeder::class);

		// // Note:
		$this->call(\Database\Seeders\Share\TemplateSeeder::class);

		// TODO don't run in live
		$this->call(\Database\Seeders\Landlord\AccountSeeder::class);
		$this->call(\Database\Seeders\Landlord\TicketSeeder::class);
		$this->call(\Database\Seeders\Landlord\CommentSeeder::class);
		$this->call(\Database\Seeders\Landlord\InvoiceSeeder::class);
		$this->call(\Database\Seeders\Landlord\PaymentSeeder::class);
	
	}
}