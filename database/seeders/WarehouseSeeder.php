<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// IQBAL
use Faker\Generator;

use App\Models\Warehouse;

class WarehouseSeeder extends Seeder
{


    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = app(Generator::class);

        $warehouses =  [
            [
                'name'          => 'Seeded (Edit as Necessary)',
                'address1'      => $faker->address,
                'address2'      => $faker->address,
                'zip'           => $faker->postcode,
                'city'          => $faker->city,
            ],
            [
                'name'          => 'Seeded at Location 1',
                'address1'      => $faker->address,
                'address2'      => $faker->address,
                'zip'           => $faker->postcode,
                'city'          => $faker->city,
            ],
            [
                'name'          => 'Seeded at Location 2',
                'address1'      => $faker->address,
                'address2'      => $faker->address,
                'zip'           => $faker->postcode,
                'city'          => $faker->city,

            ],
          ];
          //
          Warehouse::insert($warehouses);
    }
}
