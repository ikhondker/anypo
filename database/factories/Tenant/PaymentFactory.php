<?php

namespace Database\Factories\Tenant;

use Illuminate\Database\Eloquent\Factories\Factory;

Use App\Models\User;
use App\Models\Tenant\Invoice;
use App\Models\Tenant\Payment;
use App\Models\Tenant\Lookup\BankAccount;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		return [
			'invoice_id'		=> Invoice::inRandomOrder()->first()->id,
			'pay_date'			=> $this->faker->dateTimeBetween($startDate = '-1 months', $endDate = 'now', $timezone = null),
			'payee_id'			=> User::inRandomOrder()->first()->id,
			'bank_account_id'	=> BankAccount::inRandomOrder()->first()->id,
			'cheque_no'			=> $this->faker->numberBetween($min = 100000, $max = 900000),
			'amount'			=> $this->faker->numberBetween(1000,50000),
			'notes'				=> $this->faker->paragraph,
			'currency'			=> 'BDT',
			'fc_currency'		=> 'BDT',
			'fc_exchange_rate'	=> $this->faker->numberBetween(100,120),
			'fc_amount'			=> $this->faker->numberBetween(15000,25000),
		];


	}
}
