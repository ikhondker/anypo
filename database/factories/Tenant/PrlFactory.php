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
        return [
            'pr_id'             => Pr::inRandomOrder()->first()->id,
            //'project_id'        => 1001,
            'summary'           => $this->faker->sentence,
            'item_id'           => Item::inRandomOrder()->first()->id,
            'notes'             => $this->faker->paragraph,
            'qty'               => $this->faker->numberBetween(1,50),
            //'uom_id'           => Uom::inRandomOrder()->first()->id,
            'price'             => $this->faker->numberBetween(1000,20000),
            'sub_total'          => $this->faker->numberBetween(1000,20000),
            'tax'               => $this->faker->numberBetween(100,500),
            'vat'               => $this->faker->numberBetween(200,1000),
            'amount'            => $this->faker->numberBetween(1000,25000),
        ];
    }
}
