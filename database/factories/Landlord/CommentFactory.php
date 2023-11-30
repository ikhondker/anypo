<?php

namespace Database\Factories\Landlord;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;
use App\Models\Landlord\Ticket;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'content'            => $this->faker->paragraph,
            'ticket_id'           => Ticket::inRandomOrder()->first()->id,
            'owner_id'           => User::inRandomOrder()->first()->id,
        ];
    }
}
