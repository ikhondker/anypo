<?php

namespace Database\Factories\Tenant;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Tenant\Pr;
use App\Models\Tenant\Prl;
use App\Models\Tenant\Lookup\Item;
use App\Models\Tenant\Lookup\Uom;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prl>
 */
class PrlFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		$qty				= $this->faker->numberBetween(1,10);
		$price				= $this->faker->numberBetween(10,20);
		$sub_total			= $qty*$price;
		$tax				= $this->faker->numberBetween(20,40);
		$gst				= $this->faker->numberBetween(20,40);
		$fc_exchange_rate	= 125.20;

		return [
			'pr_id'				=> Pr::inRandomOrder()->first()->id,
			'summary'			=> $this->faker->randomElement(['Laptop (Lenovo)', 'Laptop (ASUS)','MacBook Air Laptop','Laptop (Dell)','iPhone 12']),
			'item_id'			=> Item::inRandomOrder()->first()->id,
			'notes'				=> $this->faker->paragraph,
			'qty'				=> $qty,
			'uom_id'			=> Uom::inRandomOrder()->first()->id,
			'price'				=> $price,
			'sub_total'			=> $sub_total,
			'tax'				=> $tax,
			'gst'				=> $gst,
			'amount'			=> $sub_total + $tax + $gst,
			'fc_sub_total'		=> $sub_total * $fc_exchange_rate,
			'fc_tax'			=> $tax * $fc_exchange_rate,
			'fc_gst'			=> $gst * $fc_exchange_rate,
			'fc_amount'			=> ($sub_total + $tax + $gst) * $fc_exchange_rate,
		];
	}
}
