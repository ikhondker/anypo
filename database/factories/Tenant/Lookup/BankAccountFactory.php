<?php

namespace Database\Factories\Tenant\Lookup;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Tenant\Lookup\BankAccount;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tenant\BankAccount>
 */
class BankAccountFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{

		$ac_number				= $this->faker->bankAccountNumber;

		return [
			'ac_name'			=> 'STD-'.$ac_number,
			'ac_number'			=> $ac_number,
			'routing_number'	=> $this->faker->bankRoutingNumber,
		];
	}
}
