<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\GlType;

class GlTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //GlType::truncate();
        //Schema::enableForeignKeyConstraints();

        $gl_types =  [
            [
                'gl_type'   => 'E',
                'name'      => 'Expense',
            ],
            [
                'gl_type'   => 'A',
                'name'      => 'Assets',
            ],
            [
                'gl_type'   => 'I',
                'name'      => 'Inventory',
            ],
        ];
        //
        GLType::insert($gl_types);
    }
}
