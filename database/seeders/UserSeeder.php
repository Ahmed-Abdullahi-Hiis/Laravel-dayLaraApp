<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
            'is_admin' => true,
        ]);

        // Blogger
        User::create([
            'name' => 'Blogger User',
            'email' => 'blogger@example.com',
            'password' => bcrypt('password123'),
            'role' => 'blogger',
            'is_admin' => false,
        ]);

        // Customer
        User::create([
            'name' => 'Customer User',
            'email' => 'customer@example.com',
            'password' => bcrypt('password123'),
            'role' => 'customer',
            'is_admin' => false,
        ]);
    }
}
