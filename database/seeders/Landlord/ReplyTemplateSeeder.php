<?php

namespace Database\Seeders\Landlord;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Landlord\Lookup\ReplyTemplate;

class ReplyTemplateSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$replyTemplate = [
			[
				'id'		=> '1001',
				'name'	=> 'First Response',
				'notes' 	=> 'We have received your ticket. We are reviewing. Will get back',
			],
			[
				'id'		=> '1002',
				'name'	=> 'Update Received',
				'notes' 	=> 'We have received your update. We are reviewing. Will get back',
			],
			[
				'id'		=> '1003',
				'name'	=> 'Send for Fix',
				'notes' 	=> 'We have sent the issue to development team for fix. Will get back',
			],
			[
				'id'		=> '1004',
				'name'	=> 'Request More Info',
				'notes' 	=> 'Could you please share any further detail like screenshot etc. That will help.',
			],
			[
				'id'		=> '1005',
				'name'	=> 'Closing',
				'notes' 	=> 'We are closing the ticket.',
			],
		];
		//
		ReplyTemplate::insert($replyTemplate);
	}
}
