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
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('pass'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Job Order',
            'email' => 'jo@gmail.com',
            'password' => bcrypt('pass'),
            'role' => 'joborder',
        ]);

        User::create([
            'name' => 'Permanent',
            'email' => 'permanent@gmail.com',
            'password' => bcrypt('pass'),
            'role' => 'permanent',
        ]);
    }
}
