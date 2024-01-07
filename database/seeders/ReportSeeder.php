<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Tenant\Report;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reports =  [
			[
				'id' 	=> 1001,
				'name' 	=> 'Test Reports',
			],
			[
				'id' 	=> 1002,
				'name' => 'Printed PO pdf',
			],
			[
				'id' 	=> 1003,
				'name' => 'Printed PR pdf',
			],
			[
				'id' 	=> 1004,
				'name' => 'Budget Utilization Report',
			],
			[
				'id' 	=> 1005,
				'name' => 'Dept Budget Utilization Report',
			],
			[
				'id' 	=> 1006,
				'name' => 'Purchase Requisition Details Report',
			],
			[
				'id' 	=> 1007,
				'name' => 'Purchase Order Details Report',
			],
			[
				'id' 	=> 1008,
				'name' => 'Goods Receipt Details Report',
			],

            [
				'id' 	=> 1009,
				'name' => 'Payment Details Report',
			],

	  ];
	  
	  Report::insert($reports);
    }
}
