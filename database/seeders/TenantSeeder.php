<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// TODO Remove Testing
use App\Models\Tenant\Pr;
use App\Models\Tenant\Po;
use App\Models\Tenant\Admin\Setup;
use App\Models\User;
use App\Models\Tenant\Workflow\Hierarchyl;

use App\Http\Controllers\Tenant\PrController;
use App\Http\Controllers\Tenant\PoController;

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
		$this->call(\Database\Seeders\ItemCategorySeeder::class);
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


		// ========================================================
		//TODO MUST Remove

		$this->call(\Database\Seeders\PrSeeder::class);
		$this->call(\Database\Seeders\PrlSeeder::class);
		$this->call(\Database\Seeders\PoSeeder::class);
		$this->call(\Database\Seeders\PolSeeder::class);
		 // TODO Remove Finally
		Pr::query()->update(['currency' => 'BDT']);
		// TODO Remove Finally
		Po::query()->update(['currency' => 'BDT']);
		// TODO Remove Finally
		Setup::query()->update(['currency' => 'BDT','country' => 'BD','freezed' => true]);

		// TODO Remove Finally
		// create hiaerarchy
		$system = User::where('email', 'system@anypo.net')->firstOrFail();
		$pr=Hierarchyl::create([
			'hid'			=> 1001,
			'approver_id'	=> $system->id,
		]);
		$po=Hierarchyl::create([
			'hid'			=> 1002,
			'approver_id'	=> $system->id,
		]);

		// recalculate Pr
		$pr = new PrController();
		$pr1001 = Pr::where('id', '1001')->firstOrFail();
		$result = $pr->recalculate($pr1001);
		$pr1002 = Pr::where('id', '1002')->firstOrFail();
		$result = $pr->recalculate($pr1002);
		$pr1003 = Pr::where('id', '1003')->firstOrFail();
		$result = $pr->recalculate($pr1002);

		// recalculate Po
		$po = new PoController();
		$po1001 = Po::where('id', '1001')->firstOrFail();
		$result = $po->recalculate($po1001);
		$po1002 = Po::where('id', '1002')->firstOrFail();
		$result = $po->recalculate($po1002);
		$po1003 = Po::where('id', '1003')->firstOrFail();
		$result = $po->recalculate($po1003);

		// $this->call(\Database\Seeders\ReceiptSeeder::class);
		// $this->call(\Database\Seeders\InvoiceSeeder::class);
		// $this->call(\Database\Seeders\PaymentSeeder::class);
		// ========================================================


   		// This seeder set create_by and updated_by to default
		$this->call(\Database\Seeders\TimestampSeeder::class);
	}
}
