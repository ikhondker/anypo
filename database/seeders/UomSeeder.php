<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

use App\Models\Tenant\Lookup\Uom;

class UomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //Schema::disableForeignKeyConstraints();
        //Uom::truncate();
        //Schema::enableForeignKeyConstraints();
        
      

        $uoms =  [
            [
                'name' => 'Each',
            ],
            [
                'name' => 'Pcs',
            ],
            [
                'name' => 'Kg',
            ],
            [
                'name' => 'Meter',
            ],
            [
                'name' => 'Day',
            ],
        ];
        //
        Uom::insert($uoms);
    }
}
