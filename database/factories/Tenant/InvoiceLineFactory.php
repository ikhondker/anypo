<?php

namespace Database\Factories\Tenant;

use App\Models\Tenant\Invoice;
use App\Models\Tenant\InvoiceLine;


use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tenant\InvoiceLine>
 */
class InvoiceLineFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		$qty				= $this->faker->numberBetween(3,6);
		//$price				= $this->faker->numberBetween(200,400);
		$price				= $this->faker->randomElement([200,300,400]);
		$sub_total			= $qty*$price;
		//$tax				= $this->faker->numberBetween(20,45);
		$tax				= $this->faker->randomElement([100,200,300]);
		//$gst				= $this->faker->numberBetween(20,45);
		$gst				= $this->faker->randomElement([50,100,150]);
		$fc_exchange_rate	= 125.20;

		return [
			'invoice_id'		=> Invoice::inRandomOrder()->first()->id,
			'summary'			=> $this->faker->randomElement(['Laptop (Lenovo)', 'Laptop (ASUS)','MacBook Air Laptop','Laptop (Dell)','iPhone 12']),
			'notes'				=> $this->faker->paragraph,
			'qty'				=> $qty,
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
