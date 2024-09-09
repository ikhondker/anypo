<?php

namespace Database\Seeders\Landlord;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Landlord\Manage\Config;

class ConfigSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		Config::truncate();
		$system = User::where('email', config('bo.SYSTEM_EMAIL_ID'))->firstOrFail();

		$configs = [
				[
					'name'				=> 'ANYPO.NET',
					'tagline'			=> 'Control Expense',
					'currency'			=> 'USD',
					'address1'			=> '3939 Lawrence Ave, E#108,',
					'address2'			=> '',
					'city'				=> 'Scarborough',
					'state'				=> 'ON',
					'zip'				=> 'M1G1R9',
					'country'			=> 'CA',
					'email'				=> 'info@anypo.net',
					'cell'				=> '+0012262804920',
					'website'			=> 'https://www.anypo.net',
					'banner_message'	=> 'This is a test public message. Will be shown only in all dashboards, when enabled.',
					'facebook'			=> 'https://www.facebook.com/my.anyponet',
					'linkedin'			=> 'https://www.linkedin.com/company/anypo-net',
					'system_user_id'	=> $system->id,
					'created_by'		=> $system->id,
					'updated_by'		=> $system->id,
				],
			];
		
			Config::insert($configs);
	}
}
