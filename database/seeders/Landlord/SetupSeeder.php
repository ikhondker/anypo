<?php

namespace Database\Seeders\Landlord;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Landlord\Manage\Setup;

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
              'name'          => 'AnyPO',
              'tagline'       => 'Control Expense',
              'currency'      => 'USD',
              'address1'      => '3939 Lawrence Ave, E#108,',
              'address2'      => '',
              'city'          => 'Scarborough',  
              'state'         => 'ON',  
              'zip'           => 'M1G1R9',
              'country'       => 'CA',
              'email'         => 'info@anypo.net',
              'cell'          => '+880 191310509',
              'website'       => 'https://www.anypo.net',
              'banner_message'=> 'This is a test public message. Will be shown only in all dashboards, when enabled.',
              'facebook'      => 'https://www.facebook.com/HawarIT',
              'linkedin'      => 'https://www.linkedin.com/company/1666430/',
              'created_by'    => 1001,
              'updated_by'    => 1001
            ],
          ];
        
          Setup::insert($setups);
    }
}
