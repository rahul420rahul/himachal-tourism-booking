<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Package;
use Illuminate\Support\Facades\DB;

class UpdatedPackageSeeder extends Seeder
{
    public function run()
    {
        // First, deactivate all existing packages instead of deleting
        Package::query()->update(['is_active' => false]);
        
        $packages = [
            // ========== PARAGLIDING COURSES ==========
            [
                'name' => 'P1 Basic Course',
                'slug' => 'p1-basic-course',
                'description' => 'Elementary Pilot (EP) certification course. Learn basics of paragliding including ground handling, meteorology, equipment knowledge, and supervised flights. Duration: 7-10 days.',
                'short_description' => 'Basic paragliding certification course for beginners',
                'price' => 30000,
                'discount_price' => null,
                'advance_payment_percentage' => 20, // 6000 advance
                'duration' => 7,
                'category' => 'Training Course',
                'package_type' => 'course',
                'location' => 'Bir Billing, Himachal Pradesh',
                'max_participants' => 10,
                'difficulty_level' => 'Beginner',
                'min_age' => 16,
                'max_age' => 60,
                'min_weight' => 40,
                'max_weight' => 120,
                'inclusions' => json_encode([
                    'Professional instructor',
                    'All equipment provided',
                    'Theory classes',
                    'Ground training',
                    'Supervised flights',
                    'Certificate on completion'
                ]),
                'exclusions' => json_encode([
                    'Accommodation',
                    'Meals',
                    'Transportation',
                    'Personal insurance'
                ]),
                'requirements' => 'Good physical fitness, No major health issues',
                'is_active' => true,
                'featured' => true,
                'sort_order' => 1
            ],
            [
                'name' => 'P2 Intermediate Course',
                'slug' => 'p2-intermediate-course',
                'description' => 'Club Pilot (CP) certification. Advanced techniques, thermal flying, cross-country basics, emergency procedures. Must have P1 certification. Duration: 10-15 days.',
                'short_description' => 'Intermediate paragliding course for P1 certified pilots',
                'price' => 30000,
                'discount_price' => null,
                'advance_payment_percentage' => 20, // 6000 advance
                'duration' => 10,
                'category' => 'Training Course',
                'package_type' => 'course',
                'location' => 'Bir Billing, Himachal Pradesh',
                'max_participants' => 8,
                'difficulty_level' => 'Intermediate',
                'min_age' => 16,
                'max_age' => 60,
                'min_weight' => 40,
                'max_weight' => 120,
                'inclusions' => json_encode([
                    'Advanced instruction',
                    'Equipment usage',
                    'Thermal flying training',
                    'Cross-country basics',
                    'Radio communication training',
                    'P2 Certificate'
                ]),
                'exclusions' => json_encode([
                    'Accommodation',
                    'Meals',
                    'Transportation',
                    'Equipment purchase'
                ]),
                'requirements' => 'P1 certification required, 25+ flights logged',
                'is_active' => true,
                'featured' => true,
                'sort_order' => 2
            ],
            [
                'name' => 'P3 Advanced Course',
                'slug' => 'p3-advanced-course',
                'description' => 'Cross Country (XC) pilot certification. Master thermal flying, long-distance flights, competition skills, advanced meteorology. Duration: 15-20 days.',
                'short_description' => 'Advanced cross-country paragliding course',
                'price' => 30000,
                'discount_price' => null,
                'advance_payment_percentage' => 20, // 6000 advance
                'duration' => 15,
                'category' => 'Training Course',
                'package_type' => 'course',
                'location' => 'Bir Billing, Himachal Pradesh',
                'max_participants' => 6,
                'difficulty_level' => 'Advanced',
                'min_age' => 18,
                'max_age' => 60,
                'min_weight' => 40,
                'max_weight' => 120,
                'inclusions' => json_encode([
                    'Expert instruction',
                    'XC flight planning',
                    'Competition preparation',
                    'Advanced meteorology',
                    'GPS navigation training',
                    'P3 Certificate'
                ]),
                'exclusions' => json_encode([
                    'Accommodation',
                    'Meals',
                    'Transportation',
                    'Competition fees'
                ]),
                'requirements' => 'P2 certification, 100+ flights, 50+ hours airtime',
                'is_active' => true,
                'featured' => false,
                'sort_order' => 3
            ],
            [
                'name' => 'P4 Tandem Pilot Course',
                'slug' => 'p4-tandem-pilot-course',
                'description' => 'Professional tandem pilot certification. Learn to fly with passengers safely. Commercial pilot training. Includes 50+ tandem flights. Duration: 30-45 days.',
                'short_description' => 'Professional tandem pilot certification course',
                'price' => 60000,
                'discount_price' => null,
                'advance_payment_percentage' => 20, // 12000 advance
                'duration' => 30,
                'category' => 'Professional Course',
                'package_type' => 'course',
                'location' => 'Bir Billing, Himachal Pradesh',
                'max_participants' => 4,
                'difficulty_level' => 'Expert',
                'min_age' => 21,
                'max_age' => 50,
                'min_weight' => 50,
                'max_weight' => 100,
                'inclusions' => json_encode([
                    'Professional tandem training',
                    'Tandem equipment usage',
                    '50+ supervised tandem flights',
                    'Passenger handling training',
                    'Commercial operations training',
                    'P4 Tandem Certificate'
                ]),
                'exclusions' => json_encode([
                    'Accommodation',
                    'Meals',
                    'Tandem equipment purchase',
                    'License fees'
                ]),
                'requirements' => 'P3 certification, 200+ solo flights, Physical fitness certificate',
                'is_active' => true,
                'featured' => true,
                'sort_order' => 4
            ],
            
            // ========== TANDEM FLYING PACKAGES ==========
            [
                'name' => 'Tandem Joy Ride (15-20 min)',
                'slug' => 'tandem-joy-ride-short',
                'description' => 'Experience the thrill of paragliding! 15-20 minutes flight with certified tandem pilot. Perfect for first-timers. Includes basic briefing and all safety equipment.',
                'short_description' => 'Short tandem paragliding experience flight',
                'price' => 2500,
                'discount_price' => null,
                'advance_payment_percentage' => 20, // 500 advance
                'duration' => 1,
                'category' => 'Tandem Flight',
                'package_type' => 'tandem',
                'location' => 'Bir Billing, Himachal Pradesh',
                'max_participants' => 1,
                'difficulty_level' => 'None',
                'min_age' => 10,
                'max_age' => 70,
                'min_weight' => 30,
                'max_weight' => 110,
                'inclusions' => json_encode([
                    'Certified tandem pilot',
                    'All safety equipment',
                    'Pre-flight briefing',
                    'GoPro video (on request)',
                    'Transportation to take-off',
                    'Flight certificate'
                ]),
                'exclusions' => json_encode([
                    'Personal insurance',
                    'Food and drinks',
                    'Accommodation',
                    'Photos/videos (extra charge)'
                ]),
                'requirements' => 'No flying experience needed, Basic fitness required',
                'is_active' => true,
                'featured' => true,
                'sort_order' => 5
            ],
            [
                'name' => 'Tandem Classic Flight (25-40 min)',
                'slug' => 'tandem-classic-flight',
                'description' => 'Extended tandem flight for maximum enjoyment. 25-40 minutes of pure flying bliss. Thermal flying when conditions permit. Spectacular valley views.',
                'short_description' => 'Classic tandem paragliding experience',
                'price' => 4000,
                'discount_price' => null,
                'advance_payment_percentage' => 20, // 800 advance
                'duration' => 1,
                'category' => 'Tandem Flight',
                'package_type' => 'tandem',
                'location' => 'Bir Billing, Himachal Pradesh',
                'max_participants' => 1,
                'difficulty_level' => 'None',
                'min_age' => 10,
                'max_age' => 70,
                'min_weight' => 30,
                'max_weight' => 110,
                'inclusions' => json_encode([
                    'Expert tandem pilot',
                    'Premium safety equipment',
                    'Detailed briefing',
                    'Thermal flying (conditions permitting)',
                    'HD video recording',
                    'Transportation',
                    'Flight certificate'
                ]),
                'exclusions' => json_encode([
                    'Personal insurance',
                    'Meals',
                    'Accommodation',
                    'Extra photo packages'
                ]),
                'requirements' => 'No experience required, Standard fitness level',
                'is_active' => true,
                'featured' => true,
                'sort_order' => 6
            ],
            [
                'name' => 'Tandem Cross Country (45-60 min)',
                'slug' => 'tandem-cross-country',
                'description' => 'Ultimate tandem experience! 45-60 minutes cross-country flight. Soar with eagles, experience thermals, fly over multiple valleys. For adventure seekers!',
                'short_description' => 'Extended cross-country tandem flight',
                'price' => 6500,
                'discount_price' => null,
                'advance_payment_percentage' => 20, // 1300 advance
                'duration' => 1,
                'category' => 'Tandem Flight',
                'package_type' => 'tandem',
                'location' => 'Bir Billing, Himachal Pradesh',
                'max_participants' => 1,
                'difficulty_level' => 'None',
                'min_age' => 12,
                'max_age' => 65,
                'min_weight' => 35,
                'max_weight' => 100,
                'inclusions' => json_encode([
                    'Senior tandem pilot',
                    'Premium equipment',
                    'Extended briefing',
                    'Cross-country flight',
                    'Multiple thermal climbs',
                    '4K video + photos',
                    'Transportation',
                    'Special flight certificate',
                    'Refreshments'
                ]),
                'exclusions' => json_encode([
                    'Insurance',
                    'Meals',
                    'Accommodation',
                    'Additional media copies'
                ]),
                'requirements' => 'Good physical condition, No heart conditions',
                'is_active' => true,
                'featured' => false,
                'sort_order' => 7
            ]
        ];

        foreach ($packages as $packageData) {
            Package::updateOrCreate(
                ['slug' => $packageData['slug']],
                $packageData
            );
        }

        echo "✅ 6 Packages created successfully!\n";
        echo "- 4 Training Courses (P1, P2, P3, P4)\n";
        echo "- 3 Tandem Flights (15-20min, 25-40min, 45-60min)\n";
    }
}
