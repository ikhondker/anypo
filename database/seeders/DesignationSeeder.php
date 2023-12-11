<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Tenant\Lookup\Designation;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

      Designation::truncate();

        $designations =  [
            [
                'id'    => '1001',
                'name'  => 'Lead Software Engineer',
            ],
            [
                'id'    => '1002',
                'name'  => 'Lead CAD/GIS Operator',
            ],
            [
                'id'    => '1003',
                'name'  => 'Lead System Engineer',
            ],
            [
                'id'    => '1004',
                'name'  => 'Manager Finance & HR',
            ],
            [
                'id'    => '1005',
                'name'  => 'Cook',
            ],
            [
                'id'    => '1006',
                'name'  => 'Sr. CAD/GIS Specialist',
            ],
            [
                'id'    => '1007',
                'name'  => 'Security Guard',
            ],
        ];
        //
        Designation::insert($designations);
    }
}
