<?php

namespace Database\Factories\Tenant\Lookup;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		return [
			'name'			=> $this->faker->company,
			'address1'		=> $this->faker->address,
			'address2'		=> $this->faker->address,
			'city'			=> $this->faker->city,
			'state'			=> $this->faker->stateAbbr,
			'zip'			=> $this->faker->postcode,
			'website'		=> $this->faker->domainName,
			'cell'			=> $this->faker->PhoneNumber,
			'email'		   > $this->faker->email,
		];
	}
}
