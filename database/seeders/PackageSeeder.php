<?php
// File: database/seeders/PackageSeeder.php
// Create this file by running: php artisan make:seeder PackageSeeder

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Package;

class PackageSeeder extends Seeder
{
    public function run()
    {
        // Clear existing packages (optional - remove if you want to keep existing)
        // Package::truncate();

        $packages = [
            // Training Packages
            [
                'name' => 'P1-P2 Basic Paragliding Course',
                'description' => 'Complete beginner paragliding course covering ground handling, theory, and supervised flights. Get your P1 and P2 license with certified APPI/SAHPA instructors.',
                'short_description' => 'Learn paragliding from scratch with P1-P2 certification',
                'price' => 30000,
                'discount_price' => null,
                'duration' => '15', // 15 days
                'max_participants' => 6,
                'inclusions' => [
                    'All equipment provided',
                    'APPI P1-P2 certification',
                    'Theory classes',
                    'Ground handling training',
                    'Supervised flights',
                    'Accommodation assistance',
                    'Pick up and drop'
                ],
                'exclusions' => [
                    'Personal expenses',
                    'Meals',
                    'Travel insurance',
                    'Medical certificate'
                ],
                'requirements' => [
                    'Age: 16-50 years',
                    'Weight: 40-100 kg',
                    'Medical fitness certificate',
                    'No fear of heights'
                ],
                'difficulty_level' => 'Beginner',
                'category' => 'training',
                'location' => 'Bir Billing, Himachal Pradesh',
                'latitude' => 32.0500,
                'longitude' => 76.7300,
                'is_active' => true,
                'featured' => true,
                'sort_order' => 1,
                'weather_dependency' => ['wind_speed', 'visibility', 'precipitation'],
                'requires_weather_check' => true,
                'advance_payment_percentage' => 50,
                'available_time_slots' => [
                    'morning' => ['09:00', '10:00'],
                    'afternoon' => ['14:00', '15:00']
                ]
            ],
            [
                'name' => 'P3 Intermediate Paragliding Course',
                'description' => 'Advanced paragliding course for P3 certification. Learn thermal flying, cross-country techniques, and advanced meteorology.',
                'short_description' => 'Advance your skills with P3 intermediate certification',
                'price' => 30000,
                'discount_price' => null,
                'duration' => '10', // 10 days
                'max_participants' => 4,
                'inclusions' => [
                    'Advanced equipment',
                    'P3 certification',
                    'Thermal flying training',
                    'Cross-country techniques',
                    'Radio communication',
                    'Weather analysis'
                ],
                'exclusions' => [
                    'Personal expenses',
                    'Meals',
                    'Travel insurance',
                    'P1-P2 prerequisite'
                ],
                'requirements' => [
                    'P1-P2 certified',
                    'Minimum 25 supervised flights',
                    'Age: 18-45 years',
                    'Advanced medical certificate'
                ],
                'difficulty_level' => 'Intermediate',
                'category' => 'training',
                'location' => 'Bir Billing, Himachal Pradesh',
                'latitude' => 32.0500,
                'longitude' => 76.7300,
                'is_active' => true,
                'featured' => true,
                'sort_order' => 2,
                'weather_dependency' => ['wind_speed', 'visibility', 'precipitation', 'thermals'],
                'requires_weather_check' => true,
                'advance_payment_percentage' => 50
            ],
            [
                'name' => 'P4 Advanced Paragliding Course',
                'description' => 'Master level paragliding course for P4 certification. Includes advanced XC flying, competition preparation, and instructor training basics.',
                'short_description' => 'Master paragliding with P4 advanced certification',
                'price' => 60000,
                'discount_price' => 55000,
                'duration' => '20', // 20 days
                'max_participants' => 3,
                'inclusions' => [
                    'Professional equipment',
                    'P4 certification',
                    'XC flying training',
                    'Competition preparation',
                    'Instructor basics',
                    'Advanced meteorology',
                    'Emergency procedures'
                ],
                'exclusions' => [
                    'Personal expenses',
                    'Competition fees',
                    'Travel insurance',
                    'Equipment purchase'
                ],
                'requirements' => [
                    'P3 certified',
                    'Minimum 100 flights',
                    'Cross-country experience',
                    'Age: 20-40 years'
                ],
                'difficulty_level' => 'Advanced',
                'category' => 'training',
                'location' => 'Bir Billing, Himachal Pradesh',
                'latitude' => 32.0500,
                'longitude' => 76.7300,
                'is_active' => true,
                'featured' => true,
                'sort_order' => 3,
                'weather_dependency' => ['wind_speed', 'visibility', 'precipitation', 'thermals', 'turbulence'],
                'requires_weather_check' => true,
                'advance_payment_percentage' => 60
            ],

            // Tandem Flight Packages
            [
                'name' => 'Short Tandem Flight (15-20 minutes)',
                'description' => 'Experience the joy of paragliding with our short tandem flight. Perfect for first-timers and those wanting a quick taste of flying.',
                'short_description' => 'Quick introduction flight for beginners',
                'price' => 2500,
                'discount_price' => null,
                'duration' => '1', // Same day
                'max_participants' => 1,
                'inclusions' => [
                    'Certified tandem pilot',
                    'All safety equipment',
                    'Pre-flight briefing',
                    'Photos and videos',
                    'Certificate of flight'
                ],
                'exclusions' => [
                    'Transportation',
                    'Meals',
                    'Insurance',
                    'Weather delays'
                ],
                'requirements' => [
                    'Age: 12-65 years',
                    'Weight: 35-90 kg',
                    'Basic fitness',
                    'No serious medical conditions'
                ],
                'difficulty_level' => 'Easy',
                'category' => 'tandem',
                'location' => 'Bir Billing, Himachal Pradesh',
                'latitude' => 32.0500,
                'longitude' => 76.7300,
                'is_active' => true,
                'featured' => true,
                'sort_order' => 4,
                'weather_dependency' => ['wind_speed', 'visibility'],
                'requires_weather_check' => true,
                'advance_payment_percentage' => 30,
                'available_time_slots' => [
                    'morning' => ['09:00', '09:30', '10:00', '10:30', '11:00'],
                    'afternoon' => ['14:00', '14:30', '15:00', '15:30', '16:00']
                ]
            ],
            [
                'name' => 'Medium Tandem Flight (25-40 minutes)',
                'description' => 'Extended tandem flight offering more time to enjoy the scenic beauty of Himalayan valleys and learn basic flying techniques.',
                'short_description' => 'Extended flight with scenic valley views',
                'price' => 4000,
                'discount_price' => 3500,
                'duration' => '1', // Same day
                'max_participants' => 1,
                'inclusions' => [
                    'Experienced tandem pilot',
                    'Premium safety equipment',
                    'Extended flight time',
                    'Professional photos/videos',
                    'Flight certificate',
                    'Basic flying explanation'
                ],
                'exclusions' => [
                    'Transportation',
                    'Meals',
                    'Insurance',
                    'Weather delays'
                ],
                'requirements' => [
                    'Age: 14-60 years',
                    'Weight: 40-85 kg',
                    'Good physical condition',
                    'No vertigo issues'
                ],
                'difficulty_level' => 'Easy',
                'category' => 'tandem',
                'location' => 'Bir Billing, Himachal Pradesh',
                'latitude' => 32.0500,
                'longitude' => 76.7300,
                'is_active' => true,
                'featured' => true,
                'sort_order' => 5,
                'weather_dependency' => ['wind_speed', 'visibility', 'thermals'],
                'requires_weather_check' => true,
                'advance_payment_percentage' => 35
            ],
            [
                'name' => 'Long Tandem Flight (45-60 minutes)',
                'description' => 'Ultimate tandem flying experience with maximum flight time, thermal flying, and breathtaking aerial photography opportunities.',
                'short_description' => 'Ultimate flying experience with thermal soaring',
                'price' => 6500,
                'discount_price' => null,
                'duration' => '1', // Same day
                'max_participants' => 1,
                'inclusions' => [
                    'Expert tandem pilot',
                    'Premium equipment',
                    'Maximum flight time',
                    'Thermal flying experience',
                    'Professional photography',
                    '4K video recording',
                    'Detailed flight certificate',
                    'Refreshments'
                ],
                'exclusions' => [
                    'Transportation',
                    'Meals (except refreshments)',
                    'Insurance',
                    'Weather delays'
                ],
                'requirements' => [
                    'Age: 16-55 years',
                    'Weight: 45-80 kg',
                    'Excellent physical condition',
                    'No fear of heights'
                ],
                'difficulty_level' => 'Moderate',
                'category' => 'tandem',
                'location' => 'Bir Billing, Himachal Pradesh',
                'latitude' => 32.0500,
                'longitude' => 76.7300,
                'is_active' => true,
                'featured' => true,
                'sort_order' => 6,
                'weather_dependency' => ['wind_speed', 'visibility', 'thermals', 'precipitation'],
                'requires_weather_check' => true,
                'advance_payment_percentage' => 40
            ]
        ];

        foreach ($packages as $packageData) {
            Package::create($packageData);
        }

        $this->command->info('6 Packages created successfully!');
    }
}