<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Package;
use Illuminate\Support\Facades\DB;

class RealPackagesSeeder extends Seeder
{
    public function run()
    {
        $this->command->info('🗑️ Clearing old packages...');
        
        // Delete all existing packages
        Package::truncate();
        
        $this->command->info('📦 Creating real Bir Billing packages...');
        
        $packages = [
            [
                'name' => 'P1-P2 Basic Ground Training + Solo Introduction Flying',
                'slug' => 'p1-p2-basic-ground-training-solo',
                'description' => 'Complete beginner course covering ground training and solo introduction flying. Perfect for first-time paragliding enthusiasts.',
                'short_description' => 'Basic Ground Training (3-5 Days) + Solo Introduction Flying',
                'price' => 30000.00,
                'duration' => '3-5 days',
                'max_people' => 6,
                'location' => 'Bir Billing, Himachal Pradesh',
                'includes' => 'Wind & Site Assistance, Equipment introduction, Inflation/Forward launch, Glider control, Direction control, Deflation, Pre flight check training, Direction control and drift, Body shift turns and Brake control turns, Safe gliding approach under Radio guidance, Basic air traffic rules',
                'excludes' => 'Accommodation, Food, Transportation, Personal equipment purchase',
                'image_path' => 'images/packages/p1-p2-basic-training.jpg',
                'gallery_images' => json_encode([
                    'images/packages/ground-training-1.jpg',
                    'images/packages/solo-flying-1.jpg'
                ]),
                'is_featured' => true,
                'status' => 'active',
                'category' => 'Training Course',
                'difficulty_level' => 'Beginner',
                'requirements' => 'No prior experience required. Basic physical fitness needed.',
                'safety_requirements' => 'All safety equipment provided. Professional instructor supervision at all times.'
            ],
            [
                'name' => 'P3 Intermediate Course',
                'slug' => 'p3-intermediate-course',
                'description' => 'Advanced intermediate course focusing on paragliding exercises and thermal techniques.',
                'short_description' => 'Intermediate Course (5-7 Days) - Advanced paragliding exercises',
                'price' => 30000.00,
                'duration' => '5-7 days',
                'max_people' => 6,
                'location' => 'Bir Billing, Himachal Pradesh',
                'includes' => 'Kiting introduction (on ground), Reverse launch, Big ears (safe height descending method), Pitch yaw and roll control, Normal and tight 360 turns, D RISER Turns, Hands Free/Toggle free Flying, Introduction of Thermal and ridge soaring',
                'excludes' => 'Accommodation, Food, Transportation, Personal equipment purchase',
                'image_path' => 'images/packages/p3-intermediate.jpg',
                'gallery_images' => json_encode([
                    'images/packages/kiting-training.jpg',
                    'images/packages/reverse-launch.jpg'
                ]),
                'is_featured' => true,
                'status' => 'active',
                'category' => 'Training Course',
                'difficulty_level' => 'Intermediate',
                'requirements' => 'Must have completed P1-P2 course or equivalent experience',
                'safety_requirements' => 'All safety equipment provided. Advanced instructor supervision.'
            ],
            [
                'name' => 'P4 Advanced Course',
                'slug' => 'p4-advanced-course',
                'description' => 'Professional level advanced course with cross country flying and advanced meteorology.',
                'short_description' => 'Advanced Course (15-20 Days) - Professional level training',
                'price' => 60000.00,
                'duration' => '15-20 days',
                'max_people' => 4,
                'location' => 'Bir Billing, Himachal Pradesh',
                'includes' => 'Thermalling in detail, Advanced kiting skill, Wing overs, Sharp 360s and Spiral entry, Ridge soaring, Flying on speed bar, Long-distance fly under XC Instructor (15-20 km glide, 2 hrs flying time), Advanced meteorology',
                'excludes' => 'Accommodation, Food, Transportation, Personal equipment purchase',
                'image_path' => 'images/packages/p4-advanced.jpg',
                'gallery_images' => json_encode([
                    'images/packages/thermal-flying.jpg',
                    'images/packages/cross-country.jpg',
                    'images/packages/advanced-techniques.jpg'
                ]),
                'is_featured' => true,
                'status' => 'active',
                'category' => 'Training Course',
                'difficulty_level' => 'Advanced',
                'requirements' => 'Must have completed P3 course. Strong flying experience required.',
                'safety_requirements' => 'All safety equipment provided. Expert instructor supervision for XC flights.'
            ],
            [
                'name' => 'Tandem Flying - Basic (15-20 minutes)',
                'slug' => 'tandem-flying-basic',
                'description' => 'Experience the thrill of paragliding with our certified instructors. Perfect introduction to paragliding.',
                'short_description' => 'Tandem paragliding flight - 15-20 minutes duration',
                'price' => 2500.00,
                'duration' => '15-20 minutes',
                'max_people' => 1,
                'location' => 'Bir Billing, Himachal Pradesh',
                'includes' => 'Professional certified instructor, All safety equipment, Flight photos/videos, Certificate of completion',
                'excludes' => 'Transportation to launch site, Personal items, Additional photos',
                'image_path' => 'images/packages/tandem-basic.jpg',
                'gallery_images' => json_encode([
                    'images/packages/tandem-takeoff.jpg',
                    'images/packages/tandem-flight.jpg'
                ]),
                'is_featured' => false,
                'status' => 'active',
                'category' => 'Tandem Flight',
                'difficulty_level' => 'Beginner',
                'requirements' => 'No experience required. Age 12-65 years. Weight limit: 45-90 kg.',
                'safety_requirements' => 'All safety gear provided. APPI certified instructor.'
            ],
            [
                'name' => 'Tandem Flying - Standard (25-40 minutes)',
                'slug' => 'tandem-flying-standard',
                'description' => 'Extended tandem flight experience with more time to enjoy the scenic beauty and learn basic techniques.',
                'short_description' => 'Extended tandem paragliding flight - 25-40 minutes duration',
                'price' => 4000.00,
                'duration' => '25-40 minutes',
                'max_people' => 1,
                'location' => 'Bir Billing, Himachal Pradesh',
                'includes' => 'Professional certified instructor, All safety equipment, Extended flight time, Flight photos/videos, Certificate of completion, Basic flying techniques demonstration',
                'excludes' => 'Transportation to launch site, Personal items, Professional photo package',
                'image_path' => 'images/packages/tandem-standard.jpg',
                'gallery_images' => json_encode([
                    'images/packages/extended-flight.jpg',
                    'images/packages/valley-views.jpg'
                ]),
                'is_featured' => true,
                'status' => 'active',
                'category' => 'Tandem Flight',
                'difficulty_level' => 'Beginner',
                'requirements' => 'No experience required. Age 12-65 years. Weight limit: 45-90 kg.',
                'safety_requirements' => 'All safety gear provided. APPI certified instructor. Weather dependent.'
            ],
            [
                'name' => 'Tandem Flying - Premium (45-60 minutes)',
                'slug' => 'tandem-flying-premium',
                'description' => 'Ultimate tandem flying experience with maximum flight time and advanced maneuvers demonstration.',
                'short_description' => 'Premium tandem paragliding flight - 45-60 minutes duration',
                'price' => 6500.00,
                'duration' => '45-60 minutes',
                'max_people' => 1,
                'location' => 'Bir Billing, Himachal Pradesh',
                'includes' => 'Expert certified instructor, All premium safety equipment, Maximum flight time, Professional photos/videos, Certificate of completion, Advanced flying techniques, Thermal flying experience, Landing technique demonstration',
                'excludes' => 'Transportation to launch site, Personal items, Drone photography',
                'image_path' => 'images/packages/tandem-premium.jpg',
                'gallery_images' => json_encode([
                    'images/packages/premium-flight.jpg',
                    'images/packages/thermal-experience.jpg',
                    'images/packages/advanced-maneuvers.jpg'
                ]),
                'is_featured' => true,
                'status' => 'active',
                'category' => 'Tandem Flight',
                'difficulty_level' => 'Beginner',
                'requirements' => 'No experience required. Age 16-60 years. Weight limit: 50-85 kg.',
                'safety_requirements' => 'Premium safety gear provided. Senior APPI certified instructor. Favorable weather conditions required.'
            ]
        ];

        foreach ($packages as $package) {
            Package::create($package);
            $this->command->info("✅ Created package: {$package['name']}");
        }

        $this->command->info('🎉 All real packages created successfully!');
        $this->command->info('📊 Total packages: ' . Package::count());
    }
}
