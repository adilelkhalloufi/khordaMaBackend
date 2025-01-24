<?php

namespace Database\Factories;

use App\Models\Profil;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profil>
 */
class ProfilFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            Profil::COL_COMPANY_NAME => $this->faker->company,
            Profil::COL_COINS => $this->faker->randomNumber(2),
            Profil::COL_USER_ID => User::factory(),
            


        ];
    }
}
