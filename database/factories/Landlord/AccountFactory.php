<?php

namespace Database\Factories\Landlord;

use Illuminate\Database\Eloquent\Factories\Factory;

// IQBAL
use Faker\Generator;

use App\Models\User;
use App\Models\Landlord\Account;
use App\Models\Landlord\Product;

use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account>
 */
class AccountFactory extends Factory
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
			'site'			=> Str::random(8),
			'address1'		=> $this->faker->address,
			'address2'		=> $this->faker->address,
			'city'			=> $this->faker->city,
			'state'			=> $this->faker->stateAbbr,
			'zip'			=> $this->faker->postcode,
			'owner_id'		=> User::inRandomOrder()->first()->id,
			//'product_id'	=> Product::inRandomOrder()->first()->id,
			'start_date'	=> $this->faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null),
			'end_date'		=> $this->faker->dateTimeBetween($startDate = 'now', $endDate = '1 years', $timezone = null),
			'last_bill_date'	=> $this->faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null),
			//'last_bill_from_date'	=> $this->faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null),
			//'last_bill_to_date'		=> $this->faker->dateTimeBetween($startDate = 'now', $endDate = '1 years', $timezone = null),
			'expired_at' 	=> $this->faker->dateTimeBetween($startDate = 'now', $endDate = '1 years', $timezone = null),
			'website'		=> $this->faker->domainName,
			'cell'			=> $this->faker->PhoneNumber,
			'email'			=> $this->faker->email,
			'created_by'	=> User::inRandomOrder()->first()->id,
			'updated_by'	=> User::inRandomOrder()->first()->id,
		];
	}
}
