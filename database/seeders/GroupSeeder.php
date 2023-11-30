<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Group;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Group::truncate();

        $groups =  [
            [
                'id'    => '1001',
                'name'  => "Women's Fashion",
            ],
            [
                'id'    => '1002',
                'name'  => 'Health & Beauty',
            ],
            [
                'id'    => '1003',
                'name'  => 'Watches, Bags, Jewellery',
            ],
            [
                'id'    => '1004',
                'name'  => "Men's Fashion",
            ],
            [
                'id'    => '1005',
                'name'  => 'Groceries & Pets',
            ],
            [
                'id'    => '1006',
                'name'  => 'Electronic Devices',
            ],
            [
                'id'    => '1007',
                'name'  => 'TV & Home Appliances',
            ],

          ];

          Group::insert($groups);
    }
}
