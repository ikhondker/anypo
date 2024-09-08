<?php


namespace Database\Factories\Landlord\Admin;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Landlord\Account;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
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
		return [
			'summary'		=> $this->faker->sentence,
			'invoice_no'	=> $this->faker->md5,
			'account_id'	=> Account::inRandomOrder()->first()->id,
			'price'			=> $this->faker->numberBetween(5,50),
			'discount'		=> $this->faker->numberBetween(5,50),
			'subtotal'		=> $this->faker->numberBetween(5,50),
			'tax'			=> $this->faker->numberBetween(1,5),
			'vat'			=> $this->faker->numberBetween(2,6),
			'amount'		=> $this->faker->numberBetween(6,50),
			'from_date'	 	=> $this->faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null),
			'to_date'		=> $this->faker->dateTimeBetween($startDate = 'now', $endDate = '1 years', $timezone = null),
			'due_date'		=> $this->faker->dateTimeBetween($startDate = 'now', $endDate = '1 years', $timezone = null),
		];
	}
}
