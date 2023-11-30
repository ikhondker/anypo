<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

use Faker\Generator;
use App\Models\Dept;
use App\Models\Hierarchy;

class DeptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //Schema::disableForeignKeyConstraints();
        //Dept::truncate();
        //Schema::enableForeignKeyConstraints();
        

        $faker = app(Generator::class);

        $depts =  [
            [
                'name' => 'Marketing',
                'pr_hierarchy_id' => 1002,
                'po_hierarchy_id' => Hierarchy::inRandomOrder()->first()->id,
            ],
            [
                'name' => 'Sales',
                'pr_hierarchy_id' => 1002,
                'po_hierarchy_id' => Hierarchy::inRandomOrder()->first()->id,
            ],
            [
                'name' => 'Finance',
                'pr_hierarchy_id' => 1002,
                'po_hierarchy_id' => Hierarchy::inRandomOrder()->first()->id,
          ],
            [
                'name' => 'Operation',
                'pr_hierarchy_id' => 1002,
                'po_hierarchy_id' => Hierarchy::inRandomOrder()->first()->id,
          ],
            [
                'name' => 'HR and Admin',
                'pr_hierarchy_id' => 1002,
                'po_hierarchy_id' => Hierarchy::inRandomOrder()->first()->id,
          ],
            [
                'name' => 'Management',
                'pr_hierarchy_id' => 1002,
                'po_hierarchy_id' => Hierarchy::inRandomOrder()->first()->id,
          ],
          ];
        //
        Dept::insert($depts);
    }
}
