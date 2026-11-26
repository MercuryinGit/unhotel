<?php

namespace Database\Seeders;

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
            'name' => 'super_admin',
            'email' => 'super_admin@example.com',
            'password' => bcrypt('super_admin123'),
            'role' => 'super_admin',
        ]);

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'user',
            'email' => 'user@example.com',
            'password' => bcrypt('user123'),
            'role' => 'user',
        ]);


    }
}
