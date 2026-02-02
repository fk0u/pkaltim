<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    // public function run(): void
    // {
    //     // Admin User
    //     User::factory()->create([
    //         'name' => 'Admin User',
    //         'email' => 'admin@example.com',
    //         'password' => bcrypt('password'),
    //         'role' => 'admin',
    //     ]);

    //     // Regular User
    //     User::factory()->create([
    //         'name' => 'Regular User',
    //         'email' => 'user@example.com',
    //         'password' => bcrypt('password'),
    //         'role' => 'user',
    //     ]);

    //     $this->call([
    //         CategorySeeder::class,
    //         PlaceSeeder::class,
    //         KulinerSeeder::class,
    //     ]);
    // }
}
