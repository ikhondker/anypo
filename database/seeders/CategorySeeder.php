<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //Schema::disableForeignKeyConstraints();
        //Category::truncate();
       // Schema::enableForeignKeyConstraints();

        $categories =  [
            [
                'name' => 'Undefined',
            ],
            [
                'name' => 'Tax',
            ],
            [
                'name' => 'Internet Bill',
            ],
            [
                'name' => 'Cafeteria',
            ],
            [
                'name' => 'Petty Cash',
            ],
            [
                'name' => 'Vehicle Maintenance',
            ],
            [
                'name' => 'Vehicle Servicing',
            ],
            [
                'name' => 'OFFICE-EQP',
            ],

      ];
      //
      Category::insert($categories);
    }
}
