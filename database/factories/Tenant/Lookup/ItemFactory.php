<?php

namespace Database\Factories\Tenant\Lookup;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Tenant\Lookup\Category;
use App\Models\Tenant\Lookup\Oem;
use App\Models\Tenant\Lookup\Uom;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //id name notes code category_id oem_id uom_id price stock reorder item_type photo enable created_by created_at updated_by updated_at

        return [
            'name'          => $this->faker->company,
            'notes'         => $this->faker->paragraph,
            'price'         => $this->faker->numberBetween($min = 1000, $max = 9000),
            'stock'         => $this->faker->numberBetween($min = 10, $max = 90),
            'reorder'       => $this->faker->numberBetween($min = 10, $max = 90),
            'category_id'   => Category::inRandomOrder()->first()->id,
            'oem_id'        => Oem::inRandomOrder()->first()->id,
            'uom_id'        => Uom::inRandomOrder()->first()->id,
        ];
    }
}
