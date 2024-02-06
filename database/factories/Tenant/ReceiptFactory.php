<?php

namespace Database\Factories\Tenant;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;
use App\Models\Tenant\Pol;
use App\Models\Tenant\Lookup\Warehouse;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Receipt>
 */
class ReceiptFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		return [
			'receive_date'	=> $this->faker->dateTimeBetween($startDate = '-1 months', $endDate = 'now', $timezone = null),
			'pol_id'		=> Pol::inRandomOrder()->first()->id,
			'warehouse_id'	=> Warehouse::inRandomOrder()->first()->id,
			'receiver_id'	=> User::inRandomOrder()->first()->id,
			'qty'			=> $this->faker->numberBetween(1,50),
			'notes'			=> $this->faker->paragraph,
		];

	}
}
