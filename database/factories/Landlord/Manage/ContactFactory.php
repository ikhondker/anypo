<?php

namespace Database\Factories\Landlord\Manage;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{

		return [
			'first_name'	=> $this->faker->name,
			'last_name'		=> $this->faker->name,
			'email'			=> $this->faker->email,
			'cell'			=> $this->faker->PhoneNumber,
			'subject'		=> $this->faker->sentence,
			'notes'		=> $this->faker->paragraph,
			'contact_date'	=> $this->faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null),
			'ip'			=> '192.168.50.1',
		];
	}
}
