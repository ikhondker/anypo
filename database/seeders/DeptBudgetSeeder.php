<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

use Faker\Generator;
use App\Models\Tenant\Budget;
use App\Models\Tenant\DeptBudget;

class DeptBudgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //Schema::disableForeignKeyConstraints();
        //DeptBudget::truncate();
        //Schema::enableForeignKeyConstraints();

        $faker = app(Generator::class);

        $deptBudget =  [
            [
                'budget_id'         => Budget::inRandomOrder()->first()->id,
                'dept_id'           => '1001',
                'amount'            => 1000000,
            ],
            [
                'budget_id'         => Budget::inRandomOrder()->first()->id,
                'dept_id'           => '1002',
                'amount'            => 1000000,
            ],
            [
                'budget_id'         => Budget::inRandomOrder()->first()->id,
                'dept_id'           => '1003',
                'amount'            => 1000000,
            ],
            [
                'budget_id'         => Budget::inRandomOrder()->first()->id,
                'dept_id'           => '1004',
                'amount'            => 1000000,
            ],
            [
                'budget_id'         => Budget::inRandomOrder()->first()->id,
                'dept_id'           => '1005',
                'amount'            => 1000000,
            ],
            [
                'budget_id'         => Budget::inRandomOrder()->first()->id,
                'dept_id'           => '1006',
                'amount'            => 1000000,
          ],
          ];
        //
        DeptBudget::insert($deptBudget);

    }
}
