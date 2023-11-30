<?php

namespace Database\Seeders\Landlord;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Landlord\Admin\Priority;

class PrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Priority::truncate();
        
        $priorities =  [
                [
                    'name' => 'Low',
                    'badge' => 'info',
                ],
                [
                    'name' => 'Medium',
                    'badge' => 'primary',
                ],
                [
                    'name' => 'High',
                    'badge' => 'danger',
                ],
            ];
        Priority::insert($priorities);
    }
}
