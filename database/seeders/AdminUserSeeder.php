<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@chamel.com'],
            [
                'name' => 'Admin User',
                'email' => 'admin@chamel.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        echo "Admin user created!\n";
        echo "Email: admin@chamel.com\n";
        echo "Password: admin123\n";
    }
}
