<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// TODO Remove Testing
use App\Models\Tenant\Pr;
use App\Models\Tenant\Po;
use App\Models\Tenant\Lookup\Currency;
use App\Models\Tenant\Admin\Setup;
use App\Models\User;
use App\Models\Tenant\Workflow\Hierarchyl;
use App\Http\Controllers\Tenant\PrController;
use App\Http\Controllers\Tenant\PoController;

use App\Enum\Tenant\AuthStatusEnum;

class DemoSeeder extends Seeder
{
		/**
		 * Run the database seeds.
		 */
		public function run(): void
		{

		// ========================================================
		$this->call(\Database\Seeders\PrSeeder::class);
		$this->call(\Database\Seeders\PrlSeeder::class);
		$this->call(\Database\Seeders\PoSeeder::class);
		$this->call(\Database\Seeders\PolSeeder::class);

		Pr::query()->update(['currency' => 'BDT']);

		Po::query()->update(['currency' => 'BDT']);

		Setup::query()->update(['currency' => 'BDT','country' => 'BD','freezed' => true]);

        // Enable BDT
        Currency::where('currency','BDT')->update(['enable'=>true]);

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
		$result = $pr->recalculate($pr1003);

        // Approve 1 pr
        $pr1001->auth_status	= AuthStatusEnum::APPROVED->value;
        $pr1001->auth_date		= date('Y-m-d H:i:s');
        $pr1001->auth_user_id	= auth()->user()->id;
        $pr1001->save();

		// recalculate Po
		$po = new PoController();
		$po1001 = Po::where('id', '1001')->firstOrFail();
		$result = $po->recalculate($po1001);
		$po1002 = Po::where('id', '1002')->firstOrFail();
		$result = $po->recalculate($po1002);
		$po1003 = Po::where('id', '1003')->firstOrFail();
		$result = $po->recalculate($po1003);

        // Approve 1 po
        $po1001->auth_status	= AuthStatusEnum::APPROVED->value;
        $po1001->auth_date		= date('Y-m-d H:i:s');
        $po1001->auth_user_id	= auth()->user()->id;
        $po1001->save();

		// $this->call(\Database\Seeders\ReceiptSeeder::class);
		// $this->call(\Database\Seeders\InvoiceSeeder::class);
		// $this->call(\Database\Seeders\PaymentSeeder::class);
		// ========================================================

	}
}
