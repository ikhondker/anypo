<?php

namespace Database\Seeders\Landlord;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Landlord\Dept;

class DeptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $depts =  [
            [
              'name' => 'General',
            ],
            [
              'name' => 'Sales',
            ],
            [
            'name' => 'Billing',
            ],
            [
            'name' => 'Technical',
            ],
          ];
          //
          Dept::insert($depts);
    }
}
