<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Tenant\Pr;
use App\Http\Controllers\Tenant\PrController;
use App\Models\Tenant\Po;
use Illuminate\Support\Facades\Auth;


class WfSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		//
        // Auth::loginUsingId(1001, TRUE);

        // // recalculate
        // $pr1 = Pr::where('id', '1003')->firstOrFail();
        // $pr = new PrController();
        // $result = $pr->recalculate($pr1);
	}
}
