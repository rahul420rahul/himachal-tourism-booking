<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class CreateAdminUserSeeder extends Seeder
{
    public function run()
    {
        // Check if admin exists
        $admin = User::where('email', 'admin@mybirbilling.com')->first();
        
        if (!$admin) {
            User::create([
                'name' => 'Super Admin',
                'email' => 'admin@mybirbilling.com',
                'password' => bcrypt('Admin@123'),
                'role' => 'admin'
            ]);
            
            echo "Admin created successfully!\n";
            echo "Email: admin@mybirbilling.com\n";
            echo "Password: Admin@123\n";
        } else {
            // Update existing admin password
            $admin->password = bcrypt('Admin@123');
            $admin->save();
            
            echo "Admin password updated!\n";
            echo "Email: admin@mybirbilling.com\n";
            echo "Password: Admin@123\n";
        }
    }
}
