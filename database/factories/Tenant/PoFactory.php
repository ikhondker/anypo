<?php

namespace Database\Factories\Tenant;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;
use App\Models\Tenant\DeptBudget;

use App\Models\Tenant\Lookup\Dept;
use App\Models\Tenant\Lookup\Supplier;
use App\Models\Tenant\Lookup\Project;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Po>
 */
class PoFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		$sub_total			= $this->faker->numberBetween(1000,20000);
		$tax				= $this->faker->numberBetween(100,500);
		$gst				= $this->faker->numberBetween(200,1000);
		$fc_exchange_rate	= 125.20;

		return [
			'summary'			=> $this->faker->sentence,
			'currency'			=> $this->faker->randomElement(['BDT', 'USD']),
			'requestor_id'		=> User::inRandomOrder()->first()->id,
			'buyer_id'			=> User::inRandomOrder()->first()->id,
			'dept_id'			=> Dept::inRandomOrder()->first()->id,
			'dept_budget_id'	=> DeptBudget::inRandomOrder()->first()->id,
			'supplier_id'		=> Supplier::inRandomOrder()->first()->id,
			'project_id'		=> Project::inRandomOrder()->first()->id,
			'po_date'			=> $this->faker->dateTimeBetween($startDate = '-1 months', $endDate = 'now', $timezone = null),
			'notes'			  	=> $this->faker->paragraph,
			'sub_total'			=> $sub_total,
			'tax'				=> $tax,
			'gst'				=> $gst,
			'amount'			=> $sub_total + $tax + $gst,
			'fc_currency'		=> 'BDT',
			'fc_exchange_rate'	=> $fc_exchange_rate,
			'fc_sub_total'		=> $sub_total * $fc_exchange_rate,
			'fc_tax'			=> $tax * $fc_exchange_rate,
			'fc_gst'			=> $gst * $fc_exchange_rate,
			'fc_amount'			=> ($sub_total + $tax + $gst) * $fc_exchange_rate,
		];
	}
}
