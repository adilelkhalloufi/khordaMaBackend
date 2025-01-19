<?php

namespace Database\Factories;

use App\enum\ProductStatue;
use App\Models\Categorie;
use App\Models\Unite;
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
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'price' => $this->faker->randomFloat(2, 0, 1000),
            'quantity' => $this->faker->randomNumber(2),
            'categorie_id' => Categorie::factory(),
            'unite_id' => Unite::factory(),
            'status' => $this->faker->randomElement([ProductStatue::Inspection, ProductStatue::ShowDetail, ProductStatue::Close]),
        ];
    }
}
