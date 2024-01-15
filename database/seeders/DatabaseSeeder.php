<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{

		/*
		|-----------------------------------------------------------------------------
		| Landlord																	 + 
		|-----------------------------------------------------------------------------
		*/
		$this->call(\Database\Seeders\Landlord\UserSeeder::class);
		$this->call(\Database\Seeders\Landlord\MenuSeeder::class);
		$this->call(\Database\Seeders\Landlord\StatusSeeder::class);
		$this->call(\Database\Seeders\Landlord\TemplateSeeder::class);
		$this->call(\Database\Seeders\Landlord\EntitySeeder::class);
		$this->call(\Database\Seeders\Landlord\SetupSeeder::class);
		$this->call(\Database\Seeders\Landlord\ContactSeeder::class);
		$this->call(\Database\Seeders\Landlord\CategorySeeder::class);

		$this->call(\Database\Seeders\Landlord\CountrySeeder::class);
		$this->call(\Database\Seeders\Landlord\DeptSeeder::class);
		$this->call(\Database\Seeders\Landlord\PrioritySeeder::class);
		$this->call(\Database\Seeders\Landlord\RatingSeeder::class);
		$this->call(\Database\Seeders\Landlord\PaymentMethodSeeder::class);

		$this->call(\Database\Seeders\Landlord\ProductSeeder::class);
		//$this->call(\Database\Seeders\Landlord\AccountSeeder::class);
		//$this->call(\Database\Seeders\Landlord\TicketSeeder::class);
		//$this->call(\Database\Seeders\Landlord\CommentSeeder::class);
		//$this->call(\Database\Seeders\Landlord\InvoiceSeeder::class);
		//$this->call(\Database\Seeders\Landlord\PaymentSeeder::class);
		
		/*
		|-----------------------------------------------------------------------------
		| Tenant																	 + 
		|-----------------------------------------------------------------------------
		*/

		// \App\Models\User::factory(10)->create();

		// \App\Models\User::factory()->create([
		//	'name' => 'Test User',
		//	'email' => 'test@example.com',
		// ]);
	}
}
