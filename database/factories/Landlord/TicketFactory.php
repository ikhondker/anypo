<?php

namespace Database\Factories\Landlord;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;
use App\Models\Landlord\Lookup\Dept;
use App\Models\Landlord\Account;
use App\Models\Landlord\Manage\Status;

use App\Models\Landlord\Manage\Priority;
use App\Models\Landlord\Lookup\Rating;


use App\Enum\LandlordTicketStatusEnum;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		return [
			'title'			=> $this->faker->sentence,
			//'ticket_number'	=> $this->faker->randomNumber(5, true),
			'content'		=> $this->faker->paragraph,
			//'owner_id'	=> User::inRandomOrder()->first()->id,
			'owner_id'		=> User::inRandomOrder()->first()->id,
			//'account_id'	=> Account::inRandomOrder()->first()->id,
			'dept_id'		=> Dept::inRandomOrder()->first()->id,
			'priority_id'	=> Priority::inRandomOrder()->first()->id,
			'rating_id'		=> Rating::inRandomOrder()->first()->id,
			//'status_id'	=> LandlordTicketStatusEnum::NEW->value,
		];
	}
}
