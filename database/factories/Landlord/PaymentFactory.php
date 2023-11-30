<?php

namespace Database\Factories\Landlord;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Landlord\Invoice;
use App\Models\Landlord\Admin\PaymentMethod;

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
            'pay_date'              => $this->faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null),
            'summary'               => $this->faker->sentence,
            'invoice_id'            => Invoice::inRandomOrder()->first()->id,
            'payment_method_id'     => PaymentMethod::inRandomOrder()->first()->id,
            'amount'                => $this->faker->numberBetween(5,25),
            'payment_token'         => $this->faker->md5,
            'reference_id'          => $this->faker->md5,
            'notes'                 => $this->faker->paragraph,
        ];
    }
}
