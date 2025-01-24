<?php

namespace Database\Factories;

use App\EnumTypeStatue;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            
            'user_id' => User::factory(),
            'product_id' => Product::factory(),
            'quantity' => random_int(1, 4),
            'price' => $this->faker->randomNumber(2),
            'status' => $this->faker->randomElement([EnumTypeStatue::ShowDetail, EnumTypeStatue::Inspection]),
        ];
    }
}
