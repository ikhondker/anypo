<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


use App\Models\Dept;
use App\Models\DeptBudget;
use App\Models\User;
use App\Models\Supplier;
use App\Models\Project;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pr>
 */
class PrFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'summary'           => $this->faker->sentence,
            'requestor_id'      => User::inRandomOrder()->first()->id,
            'dept_id'           => Dept::inRandomOrder()->first()->id,
            'dept_budget_id'    => DeptBudget::inRandomOrder()->first()->id,
            'supplier_id'       => Supplier::inRandomOrder()->first()->id,
            'project_id'        => Project::inRandomOrder()->first()->id,
            'pr_date'           => $this->faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null),
            'notes'             => $this->faker->paragraph,
            'sub_total'         => $this->faker->numberBetween(1000,20000),
            'tax'               => $this->faker->numberBetween(100,500),
            'vat'               => $this->faker->numberBetween(200,1000),
            'shipping'          => $this->faker->numberBetween(100,400),
            'discount'          => $this->faker->numberBetween(-100,-500),
            'amount'            => $this->faker->numberBetween(1000,25000),
        ];
    }
}
