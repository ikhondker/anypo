<?php

namespace Database\Factories\Tenant;

use Illuminate\Database\Eloquent\Factories\Factory;

Use App\Models\User;
Use App\Models\Tenant\Po;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tenant\Invoice>
 */
class InvoiceFactory extends Factory
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

		return
		 [
			'summary'			=> $this->faker->sentence,
			'invoice_no'		=> $this->faker->postcode,
			'invoice_date'		=> $this->faker->dateTimeBetween($startDate = '-1 months', $endDate = 'now', $timezone = null),
			'creator_id'		=> User::inRandomOrder()->first()->id,
			'po_id'				=> Po::inRandomOrder()->first()->id,
			'sub_total'			=> $sub_total,
			'tax'				=> $tax,
			'gst'				=> $gst,
			'amount'			=> $sub_total + $tax + $gst,
			'currency'		=> 'BDT',
			'fc_currency'		=> 'BDT',
			'fc_exchange_rate'	=> $fc_exchange_rate,
			'fc_amount'			=> ($sub_total + $tax + $gst) * $fc_exchange_rate,
			'notes'				=> $this->faker->paragraph,
		];
	}
}
