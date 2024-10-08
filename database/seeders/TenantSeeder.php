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
		// Make sure SetupSeeder runs after UserSeeder as system_user_id will be generated
		$this->call(\Database\Seeders\SetupSeeder::class);

		$this->call(\Database\Seeders\EntitySeeder::class);
		$this->call(\Database\Seeders\StatusSeeder::class);
		$this->call(\Database\Seeders\CustomErrorSeeder::class);
		$this->call(\Database\Seeders\MenuSeeder::class);

		// Note:
		$this->call(\Database\Seeders\Share\TemplateSeeder::class);

		$this->call(\Database\Seeders\GroupSeeder::class);
		$this->call(\Database\Seeders\CategorySeeder::class);
		$this->call(\Database\Seeders\CountrySeeder::class);
		$this->call(\Database\Seeders\CurrencySeeder::class);

		$this->call(\Database\Seeders\HierarchySeeder::class);
		$this->call(\Database\Seeders\HierarchylSeeder::class);

		$this->call(\Database\Seeders\DeptSeeder::class);
		$this->call(\Database\Seeders\DesignationSeeder::class);

		$this->call(\Database\Seeders\GlTypeSeeder::class);

		$this->call(\Database\Seeders\OemSeeder::class);
		$this->call(\Database\Seeders\ProjectSeeder::class);
		$this->call(\Database\Seeders\SupplierSeeder::class);

		$this->call(\Database\Seeders\UomClassSeeder::class);
		$this->call(\Database\Seeders\UomSeeder::class);

		$this->call(\Database\Seeders\WarehouseSeeder::class);
		$this->call(\Database\Seeders\BankAccountSeeder::class);
		$this->call(\Database\Seeders\ItemSeeder::class);

		$this->call(\Database\Seeders\BudgetSeeder::class);
		$this->call(\Database\Seeders\DeptBudgetSeeder::class);

		$this->call(\Database\Seeders\ReportSeeder::class);

		// This seeder set create_by and updated_by to default
		$this->call(\Database\Seeders\TimestampSeeder::class);

		//TODO Remove
		$this->call(\Database\Seeders\PrSeeder::class);
		$this->call(\Database\Seeders\PrlSeeder::class);
		$this->call(\Database\Seeders\PoSeeder::class);
		$this->call(\Database\Seeders\PolSeeder::class);
		// $this->call(\Database\Seeders\ReceiptSeeder::class);
		// $this->call(\Database\Seeders\InvoiceSeeder::class);
		// $this->call(\Database\Seeders\PaymentSeeder::class);
		}
}
