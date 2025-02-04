<?php

namespace Database\Seeders;

use App\enum\ProfilStatus;
use App\enum\UserRole;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'first_name' => 'Admin Admin',
            'last_name' => 'Admin',
            'email' => 'admin@admin.com',
            'role' => UserRole::ADMIN,
            'status' => ProfilStatus::ACTIF,
            'password' => bcrypt('password'),
        ]);

        // User::factory(10)->create();
        $this->call(FamilySeeder::class);
        $this->call(UniteSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(TypeSeeder::class);
    }
}
