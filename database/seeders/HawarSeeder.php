<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Tenant\Admin\Setup;

class HawarSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		Setup::where('id', 1001)->update([
			'name'			=> 'HawarIT Limited',
			'tagline'		=> 'Working Together...',
			'address1'		=> 'Hendrik Bulthuisweg 1,',
			'address2'		=> '8606 KB, Sneek',
			'city'			=> 'Sneek',  
			'state'			=> 'KB',  
			'zip'			=> '8606',
			'country'		=> 'NL',
			'email'			=> 'info@hawarIT.com',
			'cell'			=> '+31 515 570 333',
			'website'		=> 'https://www.hawarIT.com',
			'facebook'		=> 'https://www.facebook.com/HawarIT',
			'linkedin'		=> 'https://www.linkedin.com/company/hawarit-limited/',
			'logo'			=> 'hit.jpg',
		]);

	}
}
