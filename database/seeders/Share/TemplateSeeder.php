<?php

namespace Database\Seeders\Share;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Share\Template;

class TemplateSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		Template::factory()->count(25)->create();
	}
}
