<?php

namespace Database\Factories\Tenant;

use Illuminate\Database\Eloquent\Factories\Factory;


use App\Models\Tenant\DeptBudget;
use App\Models\User;
use App\Models\Tenant\Lookup\Project;
use App\Models\Tenant\Lookup\Dept;
use App\Models\Tenant\Pr;

use App\Enum\EntityEnum;
use App\Enum\EventEnum;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tenant\Dbu>
 */
class DbuFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		return [
			'dept_budget_id'	=> DeptBudget::inRandomOrder()->first()->id,
			'entity'			=> EntityEnum::PR->value,
			'article_id'		=> Pr::inRandomOrder()->first()->id,
			'event'				=> EventEnum::BOOK->value,
			'user_id'		=> User::inRandomOrder()->first()->id,
			'dept_id'			=> Dept::inRandomOrder()->first()->id,
			'project_id'		=> Project::inRandomOrder()->first()->id,
			'amount_pr_booked'	=> $this->faker->numberBetween(200,1000),
		];
	}
}
