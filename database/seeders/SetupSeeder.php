<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Tenant\Admin\Setup;

class SetupSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		Setup::truncate();

		$sys = User::where('email', config('akk.SYS_EMAIL_ID'))->firstOrFail();
		$setups = [
			[
				'id'				=> '1001',
				'name'				=> 'ANYPO.NET',
				'tagline'			=> 'Control Expenses',
				'currency'			=> 'USD',
				//'admin_id'		=> 1001, // Set by createTenantJob
				'address1'			=> '3939 Lawrence Ave, E#108,',
				'address2'			=> '',
				'city'				=> 'Scarborough',
				'state'				=> 'ON',
				'zip'				=> 'M1G1R9',
				'country'			=> 'CA',
				'email'				=> 'info@anypo.net',
				'cell'				=> '+0012262804920',
				'website'			=> 'https://www.anypo.net',
				'sys_user_id'	    => $sys->id,
				'banner_message'	=> 'This is a test public message. Will be shown only in all dashboards, when enabled.',
				'facebook'			=> 'https://www.facebook.com/my.anyponet',
				'linkedin'			=> 'https://www.linkedin.com/company/anypo-net',
				'created_by'		=> $sys->id,
				'updated_by'		=> $sys->id,
				'tc'				=> 	'1.	Acceptance: All purchase orders are subject to acceptance by the supplier.
2.	Price and Payment: Prices are firm and as stated on the PO. Payment terms are net 30 days from receipt of a correct invoice.
3.	Inspection and Acceptance: Buyer reserves the right to inspect goods upon arrival and reject any non-conforming items.
4.	Default: Failure to deliver on time or provide conforming goods constitutes a default and allows buyer to terminate the PO and seek damages.
5.	Limitation of Liability: Seller\'s liability is limited to the purchase price of the goods.
6.	Governing Law: This agreement shall be governed by the laws of Buyer\'s Country.
7.	Amendment: Any amendment to this agreement must be made in writing and signed by both parties.'
			],
		];
		Setup::insert($setups);
	}
}
