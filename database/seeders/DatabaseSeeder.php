<?php

namespace Database\Seeders;

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
            'name' => 'Admin Admin',
            'email' => 'admin@admin.com',
            'role' => UserRole::ADMIN,
            'password' => bcrypt('password')
        ]);

        $this->call(FamilySeeder::class);
        $this->call(UniteSeeder::class);
        $this->call(CategoriesSeeder::class);
    }
}
