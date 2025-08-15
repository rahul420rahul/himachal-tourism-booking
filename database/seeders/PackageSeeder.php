<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Package;
use Illuminate\Support\Str;

class PackageSeeder extends Seeder
{
    public function run()
    {
        // Clear existing packages first
        Package::truncate();
        
        $packages = [
            [
                'name' => 'P1-P2 Basic Ground Training & Solo Introduction Flying',
                'slug' => 'p1-p2-basic-ground-training-solo-flying',
                'description' => 'This comprehensive course combines P1 Basic Ground Training (3-5 Days) and P2 Solo Introduction Flying. Perfect for complete beginners who want to start their paragliding journey safely.',
                'price' => 30000,
                'duration' => '8-10 Days',
                'is_active' => 1,
                'featured' => 1,
                'status' => 'active',
            ],
            [
                'name' => 'P3 Intermediate Course',
                'slug' => 'p3-intermediate-paragliding-course',
                'description' => 'P3 Intermediate Course (5-7 Days) focuses on advanced paragliding exercises including kiting, reverse launch, and thermal soaring techniques.',
                'price' => 30000,
                'duration' => '5-7 Days',
                'is_active' => 1,
                'featured' => 1,
                'status' => 'active',
            ],
            [
                'name' => 'P4 Advanced Course',
                'slug' => 'p4-advanced-paragliding-course',
                'description' => 'P4 Advanced Course (15-20 Days) - The ultimate paragliding course covering thermalling, advanced maneuvers, ridge soaring, and long-distance cross-country flights.',
                'price' => 60000,
                'duration' => '15-20 Days',
                'is_active' => 1,
                'featured' => 1,
                'status' => 'active',
            ],
            [
                'name' => 'Tandem Flight 15-20 Minutes',
                'slug' => 'tandem-flight-15-20-minutes',
                'description' => 'Experience the thrill of paragliding with our professional pilots in a safe 15-20 minute tandem flight over the beautiful Bir Billing valley.',
                'price' => 2500,
                'duration' => '15-20 Minutes',
                'is_active' => 1,
                'featured' => 0,
                'status' => 'active',
            ],
            [
                'name' => 'Tandem Flight 25-40 Minutes',
                'slug' => 'tandem-flight-25-40-minutes',
                'description' => 'Enjoy an extended 25-40 minute tandem paragliding flight with opportunities for thermal soaring and panoramic views of the Dhauladhar ranges.',
                'price' => 4000,
                'duration' => '25-40 Minutes',
                'is_active' => 1,
                'featured' => 1,
                'status' => 'active',
            ],
            [
                'name' => 'Tandem Flight 45-60 Minutes Premium',
                'slug' => 'tandem-flight-45-60-minutes-premium',
                'description' => 'Our premium 45-60 minute tandem flight experience includes thermal soaring, extended scenic views, and professional photography/videography package.',
                'price' => 6500,
                'duration' => '45-60 Minutes',
                'is_active' => 1,
                'featured' => 1,
                'status' => 'active',
            ]
        ];

        foreach ($packages as $packageData) {
            Package::create($packageData);
        }
        
        echo "Created " . count($packages) . " packages successfully!\n";
    }
}
