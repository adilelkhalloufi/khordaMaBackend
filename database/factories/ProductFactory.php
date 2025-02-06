<?php

namespace Database\Factories;

use App\enum\ProductAdminStatus;
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
            'name' => $this->faker->word,
            'description' => $this->faker->text,
            'price' => $this->faker->randomNumber(2),
            'quantity' => $this->faker->randomNumber(2),
            'categorie_id' => Categorie::pluck('id')->random(),

            'unite_id' => Unite::pluck('id')->random(),
            'availability_status' => $this->faker->randomElement([ProductAdminStatus::Published, ProductAdminStatus::Draft]),
            'image' => $this->faker->imageUrl(),
            'status' => $this->faker->randomElement([ProductStatue::Inspection, ProductStatue::ShowDetail, ProductStatue::Close]),
        ];
    }
}
