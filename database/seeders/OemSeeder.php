<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

use App\Models\Oem;

class OemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      //Schema::disableForeignKeyConstraints();
      //Oem::truncate();
      //Schema::enableForeignKeyConstraints();
      

      

        $oems =  [
            [
                'name' => 'General',
            ],
            [
                'name' => 'Samsung',
            ],
            [
                'name' => 'LG',
            ],
            [
                'name' => 'Oppo',
            ],
            [
                'name' => 'Aarong',
            ],
            [
                'name' => 'Nokia',
            ]
          
        ];

        Oem::insert($oems);
    }
}
