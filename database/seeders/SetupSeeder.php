<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Setup;

class SetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setup::truncate();

        $setups =  [
            [
                'id'              => '1001',
                'name'            => 'HawarIT Limited',
                'tagline'         => 'Working Together...',
                'currency'        => 'USD',
                'admin_id'        => 1001, // TODO 
                'address1'        => 'Flat#C3, Plot# 222, Road# 8,Block-C,',
                'address2'        => 'Bashundhara R/A, Dhaka -1229',
                'state'           => 'N/A',  
                'zip'             => '1229',
                'country'         => 'US',
                'email'           => 'info@yourcompany.com',
                'cell'            => '+880191310509',
                'website'         => 'https://www.yourcompany.com',
                'notice'          => 'This is a test public message. This is a test public message. This is a test public message.',
                'facebook'        => 'https://www.facebook.com/yourcompany',
                'linkedin'        => 'https://www.linkedin.com/company/1666430/',
                'created_by'      => 1,
                'updated_by'      => 1
            ],
        ];
        Setup::insert($setups);
    }
}
