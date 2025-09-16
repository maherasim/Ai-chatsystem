<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'), // Hash the password
            'is_admin' => true,                 // ✅ for boolean flag
            'type' => 'admin',                  // ✅ for type check
        ]);

        // (Optional) create some test users
        // User::factory(10)->create();
    }
}
