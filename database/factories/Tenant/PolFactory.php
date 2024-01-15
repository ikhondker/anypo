<?php

namespace Database\Factories\Tenant;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;

use App\Models\Tenant\Po;
use App\Models\Tenant\Pol;
use App\Models\Tenant\Lookup\Item;
use App\Models\Tenant\Lookup\Uom;
use App\Models\Tenant\Lookup\Dept;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pol>
 */
class PolFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		return [
			'po_id'			=> Po::inRandomOrder()->first()->id,
			'requestor_id'	=> User::inRandomOrder()->first()->id,
			'dept_id'		=> Dept::inRandomOrder()->first()->id,
			'summary'		=> $this->faker->sentence,
			'item_id'		=> Item::inRandomOrder()->first()->id,
			'notes'			=> $this->faker->paragraph,
			'qty'			=> $this->faker->numberBetween(1,50),
			'uom_id'		=> Uom::inRandomOrder()->first()->id,
			'price'			=> $this->faker->numberBetween(1000,20000),
			'sub_total'		=> $this->faker->numberBetween(1000,20000),
			'tax'			=> $this->faker->numberBetween(100,500),
			'vat'			=> $this->faker->numberBetween(200,1000),
			'amount'		=> $this->faker->numberBetween(1000,25000),
		];
	}
}
