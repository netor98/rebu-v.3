<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
   /**
    * Define the model's default state.
    *
    * @return array<string, mixed>
    */
   public function definition(): array
   {
      return [
         'name' => $this->faker->word,
         'price' => $this->faker->randomFloat(2, 1, 1000),
         'cuantity' => $this->faker->numberBetween(1, 100),
         'store_id' => \App\Models\Store::factory(),
         'description' => $this->faker->sentence,
         'image' => $this->faker->imageUrl(),
         'active' => 1,

      ];
   }
}
