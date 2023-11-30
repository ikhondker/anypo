<?php

namespace Database\Factories\Landlord;

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
            'name'          => $this->faker->company,
            'email'         => $this->faker->email,
            'phone'         => $this->faker->PhoneNumber,
            'subject'       => $this->faker->sentence,
            'message'       => $this->faker->paragraph,
            'contact_date'  => $this->faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null),
            'ip'            => '192.168.50.1',
        ];
    }
}
