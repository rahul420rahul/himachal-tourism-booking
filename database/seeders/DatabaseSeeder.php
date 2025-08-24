<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Package;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@birbilling.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        // Create packages
        Package::create([
            'name' => 'Basic Paragliding',
            'slug' => 'basic-paragliding',
            'description' => 'Experience the thrill of paragliding',
            'price' => 3000,
            'duration' => 30,
            'max_participants' => 2,
            'is_active' => true,
            'featured' => true,
        ]);
    }
}
