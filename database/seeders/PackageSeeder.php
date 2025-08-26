<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Package;

class PackageSeeder extends Seeder
{
    public function run()
    {
        // Clear existing packages
        Package::truncate();
        
        $packages = [
            // PARAGLIDING COURSES
            [
                'name' => 'P1-P2 Basic Paragliding Course',
                'slug' => 'p1-p2-basic-course',
                'description' => 'Elementary & Novice pilot certification. Ground school theory, equipment handling, forward/reverse launches, supervised flights from training hills.',
                'price' => 30000,
                'duration' => '8-10 Days',
                'is_active' => true,
                'featured' => true,
            ],
            [
                'name' => 'P3 Intermediate Paragliding Course',
                'slug' => 'p3-intermediate-course',
                'description' => 'Club pilot certification. Thermal flying, basic XC skills, emergency maneuvers, meteorology, and independent flight planning.',
                'price' => 30000,
                'duration' => '10-12 Days',
                'is_active' => true,
                'featured' => true,
            ],
            [
                'name' => 'P4 Advanced Pilot Course',
                'slug' => 'p4-advanced-course',
                'description' => 'Cross-country pilot certification. Advanced SIV training, competition skills, 50km+ XC flights, and instructor methodology basics.',
                'price' => 60000,
                'duration' => '15-20 Days',
                'is_active' => true,
                'featured' => true,
            ],
            // TANDEM FLIGHTS
            [
                'name' => 'Joy Ride Tandem Flight',
                'slug' => 'joy-ride-tandem',
                'description' => 'Short introductory tandem flight. Gentle take-off, smooth gliding over Bir valley, basic maneuvers, and soft landing.',
                'price' => 2500,
                'duration' => '15-20 Minutes',
                'is_active' => true,
                'featured' => false,
            ],
            [
                'name' => 'Classic Tandem Flight', 
                'slug' => 'classic-tandem',
                'description' => 'Standard tandem experience with thermal soaring. Higher altitude gains, valley crossing, mild aerobatics on request.',
                'price' => 4000,
                'duration' => '20-30 Minutes',
                'is_active' => true,
                'featured' => false,
            ],
            [
                'name' => 'Cross Country Tandem Flight',
                'slug' => 'xc-tandem',
                'description' => 'Premium XC tandem adventure. Maximum altitude gains, thermal hunting, ridge soaring, landing at distant LZ.',
                'price' => 6500,
                'duration' => '45-60 Minutes',
                'is_active' => true,
                'featured' => true,
            ],
        ];

        foreach ($packages as $package) {
            Package::create($package);
        }
        
        echo "6 Packages created successfully with accurate details!\n";
    }
}
