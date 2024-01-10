<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
		/**
		 * Run the database seeds.
		 */
		public function run(): void
		{
		$this->call(\Database\Seeders\UserSeeder::class);
		$this->call(\Database\Seeders\SetupSeeder::class);

		$this->call(\Database\Seeders\EntitySeeder::class);
		$this->call(\Database\Seeders\MenuSeeder::class);
		$this->call(\Database\Seeders\TemplateSeeder::class);

		$this->call(\Database\Seeders\CategorySeeder::class);
		$this->call(\Database\Seeders\CountrySeeder::class);
		$this->call(\Database\Seeders\CurrencySeeder::class);
		
		$this->call(\Database\Seeders\HierarchySeeder::class);
		$this->call(\Database\Seeders\HierarchylSeeder::class);

		$this->call(\Database\Seeders\DeptSeeder::class);
		$this->call(\Database\Seeders\DesignationSeeder::class);

		$this->call(\Database\Seeders\GlTypeSeeder::class);
		$this->call(\Database\Seeders\GroupSeeder::class);

		$this->call(\Database\Seeders\OemSeeder::class);
		$this->call(\Database\Seeders\PayMethodSeeder::class);
		$this->call(\Database\Seeders\ProjectSeeder::class);
		$this->call(\Database\Seeders\SupplierSeeder::class);
		
		$this->call(\Database\Seeders\UomClassSeeder::class);
		$this->call(\Database\Seeders\UomSeeder::class);
		$this->call(\Database\Seeders\WarehouseSeeder::class);
		$this->call(\Database\Seeders\ItemSeeder::class);

		$this->call(\Database\Seeders\BudgetSeeder::class);
		$this->call(\Database\Seeders\DeptBudgetSeeder::class);
		
		$this->call(\Database\Seeders\ReportSeeder::class);

		//TODO Remove
		//$this->call(\Database\Seeders\PrSeeder::class);
		//$this->call(\Database\Seeders\PrlSeeder::class);
		}
}
