<?php

namespace Database\Factories\Landlord\Manage;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Template>
 */
class TemplateFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		return [
			'code'			=> $this->faker->md5,
			'summary'		=> $this->faker->sentence($nbWords = 6, $variableNbWords = true),
			'name'			=> $this->faker->name(),
			'user_id'		=> User::inRandomOrder()->first()->id,
			'address1'		=> $this->faker->address(),
			'address2'		=> $this->faker->address(),
			'email'		  	=> $this->faker->safeEmail(),
			'cell'			=> $this->faker->phoneNumber(),
			'qty'			=> $this->faker->numberBetween($min = 1, $max = 10) ,
			'amount'		=> $this->faker->randomFloat($nbMaxDecimals = 2, $min = 1000, $max = 6000),
			'notes'		  	=> $this->faker->paragraph,
			'enable'		=> $this->faker->boolean(),
			'my_date'		=> now(),
			'my_date_time'  => now(),
			//'my_image'	=> $this->faker->image('public/storage/images',640,480),
			/* 'my_image'	=> $this->faker->image( storage_path('images'),640,480), */
			/*'my_image'	=> $this->faker->image( storage_path('app'),640,480), */
			/* 'my_image'	=> $this->faker->image('images',400,300, null, false), */
			/* 'my_image'	=> $this->faker->image($dir = null, $width = 640, $height = 480, $category = null, $fullPath = true, $randomize = true, $word = null, $gray = false), */
			/* 'my_date'	=> $this->faker->date($format = 'Y-m-d', $max = 'now'),*/
			/* 'my_date_time'  => $this->faker->dateTime($max = 'now', $timezone = null),*/
			'created_by'	=> User::inRandomOrder()->first()->id,
			'updated_by'	=> User::inRandomOrder()->first()->id,
		];
	}
}
