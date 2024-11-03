<?php

namespace Database\Seeders\Landlord;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Landlord\Lookup\Topic;

class TopicSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$topics = [
			['name' 	=> 'Unclassified'],
			['name' 	=> 'Getting Started'],
			['name' 	=> 'FAQ'],
			['name' 	=> 'Requisition'],
			['name' 	=> 'Purchase Order'],
			['name' 	=> 'Receipts'],
			['name' 	=> 'Invoice'],
			['name' 	=> 'Payment'],
			['name' 	=> 'Budgets'],
			['name' 	=> 'Dept Budget'],
			['name' 	=> 'Master Data'],
			['name' 	=> 'User Management'],
			['name' 	=> 'Hierarchy'],
			['name' 	=> 'Approval'],
			['name' 	=> 'Workflow'],
            ['name' 	=> 'Interface'],
			['name' 	=> 'Currency'],
			['name' 	=> 'Setup'],
			['name' 	=> 'Support'],
		];
	Topic::insert($topics);
	}
}
