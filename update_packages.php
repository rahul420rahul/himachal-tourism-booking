<?php
// Paragliding Packages Setup Script
// Save as: update_packages.php

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "🪂 Starting Paragliding Packages Setup...\n\n";

// First, delete all existing packages
App\Models\Package::truncate();

// Create Tandem Flying Packages
App\Models\Package::create([
    'name' => 'Basic Tandem Flight',
    'description' => 'Experience the thrill of paragliding with our certified instructor. Perfect for beginners and tourists. Flight duration: 10-15 minutes over the beautiful Kangra Valley.',
    'price' => 3000.00,
    'duration' => '10-15 minutes',
    'category' => 'tandem',
    'max_participants' => 1,
    'min_age' => 12,
    'max_age' => 65,
    'weight_min' => 35,
    'weight_max' => 90,
    'includes' => json_encode([
        'Professional pilot',
        'All safety equipment',
        'Pre-flight briefing',
        'Insurance coverage',
        'Basic photography'
    ]),
    'requirements' => json_encode([
        'Age: 12-65 years',
        'Weight: 35-90 kg',
        'Basic fitness required',
        'No medical conditions'
    ]),
    'weather_dependent' => true,
    'advance_booking_required' => false,
    'cancellation_policy' => '100% refund if cancelled due to weather conditions',
    'is_active' => true
]);

App\Models\Package::create([
    'name' => 'Premium Tandem Flight',
    'description' => 'Extended paragliding experience with professional photography and video. Soar high for 30+ minutes and capture unforgettable memories over Bir-Billing landscape.',
    'price' => 5000.00,
    'duration' => '30+ minutes',
    'category' => 'tandem',
    'max_participants' => 1,
    'min_age' => 12,
    'max_age' => 65,
    'weight_min' => 35,
    'weight_max' => 90,
    'includes' => json_encode([
        'Professional pilot',
        'Extended flight time',
        'All safety equipment',
        'Pre-flight briefing',
        'Professional photography',
        'HD video recording',
        'Digital photos & videos',
        'Insurance coverage',
        'Certificate of completion'
    ]),
    'requirements' => json_encode([
        'Age: 12-65 years',
        'Weight: 35-90 kg',
        'Good physical fitness',
        'No medical conditions',
        'Advance booking recommended'
    ]),
    'weather_dependent' => true,
    'advance_booking_required' => true,
    'cancellation_policy' => '100% refund if cancelled due to weather conditions. 50% refund for self-cancellation 24hrs before.',
    'is_active' => true
]);

// Create Professional Training Courses

App\Models\Package::create([
    'name' => 'P1 Basic Pilot Course',
    'description' => 'Foundation course for aspiring paraglider pilots. Learn ground handling, basic flying techniques, and safety procedures. Get your P1 certification to fly under supervision.',
    'price' => 18000.00,
    'duration' => '5-7 days',
    'category' => 'course',
    'max_participants' => 8,
    'min_age' => 16,
    'max_age' => 55,
    'weight_min' => 45,
    'weight_max' => 85,
    'includes' => json_encode([
        'Ground theory sessions',
        'Practical ground handling',
        '8-10 supervised flights',
        'All equipment provided',
        'Certified instructor',
        'Course material & books',
        'P1 certification',
        'Insurance during training',
        'Digital logbook'
    ]),
    'requirements' => json_encode([
        'Age: 16-55 years',
        'Weight: 45-85 kg',
        'Good physical fitness',
        'Medical certificate required',
        'Swimming knowledge preferred',
        '100% attendance required'
    ]),
    'weather_dependent' => true,
    'advance_booking_required' => true,
    'cancellation_policy' => 'Course can be rescheduled due to weather. 25% refund for self-cancellation before course start.',
    'is_active' => true
]);

App\Models\Package::create([
    'name' => 'P2 Novice Pilot Course',
    'description' => 'Advanced training for independent flying. Master thermal flying, navigation, and emergency procedures. Achieve P2 certification for solo cross-country flights.',
    'price' => 28000.00,
    'duration' => '8-12 days',
    'category' => 'course',
    'max_participants' => 6,
    'min_age' => 18,
    'max_age' => 50,
    'weight_min' => 45,
    'weight_max' => 85,
    'includes' => json_encode([
        'Advanced theory sessions',
        'Thermal flying techniques',
        '15-20 supervised flights',
        'Navigation training',
        'Emergency procedures',
        'Cross-country basics',
        'All equipment provided',
        'Certified instructor',
        'Course materials',
        'P2 certification',
        'Insurance coverage',
        'Digital flight logs'
    ]),
    'requirements' => json_encode([
        'P1 certification required',
        'Age: 18-50 years',
        'Weight: 45-85 kg',
        'Excellent physical fitness',
        'Medical certificate mandatory',
        'Minimum 10 P1 flights',
        '100% course attendance'
    ]),
    'weather_dependent' => true,
    'advance_booking_required' => true,
    'cancellation_policy' => 'Course rescheduling available. 15% refund for cancellation before course start.',
    'is_active' => true
]);

App\Models\Package::create([
    'name' => 'P3 Intermediate Pilot Course',
    'description' => 'Expert-level training for advanced paragliding. Learn competition techniques, advanced meteorology, and high-performance flying for serious pilots.',
    'price' => 38000.00,
    'duration' => '10-15 days',
    'category' => 'course',
    'max_participants' => 4,
    'min_age' => 20,
    'max_age' => 45,
    'weight_min' => 45,
    'weight_max' => 80,
    'includes' => json_encode([
        'Expert-level theory',
        'Advanced meteorology',
        'Competition techniques',
        'High-performance flying',
        '20-25 training flights',
        'Cross-country flights',
        'Equipment selection guidance',
        'Expert instructor',
        'Advanced course materials',
        'P3 certification',
        'Competition preparation',
        'Comprehensive insurance',
        'Professional logbook'
    ]),
    'requirements' => json_encode([
        'P2 certification required',
        'Age: 20-45 years',
        'Weight: 45-80 kg',
        'Exceptional fitness',
        'Medical certificate',
        'Minimum 50 P2 flights',
        'Advanced swimming skills',
        'Commitment to 100% attendance'
    ]),
    'weather_dependent' => true,
    'advance_booking_required' => true,
    'cancellation_policy' => 'Course rescheduling available. No refund for self-cancellation.',
    'is_active' => true
]);

// Combo Packages

App\Models\Package::create([
    'name' => 'P1 + P2 Combo Course',
    'description' => 'Complete beginner to independent pilot training package. Save money with this comprehensive course combination that takes you from zero to solo flying.',
    'price' => 42000.00,
    'duration' => '15-20 days',
    'category' => 'combo',
    'max_participants' => 6,
    'min_age' => 16,
    'max_age' => 50,
    'weight_min' => 45,
    'weight_max' => 85,
    'includes' => json_encode([
        'Complete P1 & P2 training',
        'All theory & practical sessions',
        '25-30 supervised flights',
        'Both P1 & P2 certifications',
        'All equipment provided',
        'Expert instructors',
        'Complete course materials',
        'Insurance coverage',
        'Digital logbooks',
        'Post-course support'
    ]),
    'requirements' => json_encode([
        'Age: 16-50 years',
        'Weight: 45-85 kg',
        'Excellent physical fitness',
        'Medical certificate required',
        'Full-time availability',
        '100% attendance commitment'
    ]),
    'weather_dependent' => true,
    'advance_booking_required' => true,
    'cancellation_policy' => 'Flexible rescheduling. 10% refund for cancellation before course start.',
    'is_active' => true
]);

App\Models\Package::create([
    'name' => 'Complete Pilot Training (P1+P2+P3)',
    'description' => 'Ultimate paragliding education package. From complete beginner to expert pilot. Master all aspects of paragliding with our comprehensive training program.',
    'price' => 68000.00,
    'duration' => '25-35 days',
    'category' => 'complete',
    'max_participants' => 4,
    'min_age' => 18,
    'max_age' => 45,
    'weight_min' => 45,
    'weight_max' => 80,
    'includes' => json_encode([
        'Complete P1, P2 & P3 training',
        'All theory sessions',
        '40-50 supervised flights',
        'All three certifications',
        'Equipment guidance & selection',
        'Expert instructors',
        'Complete learning materials',
        'Competition preparation',
        'Comprehensive insurance',
        'Professional logbooks',
        'Lifetime support network',
        '6 months post-course guidance'
    ]),
    'requirements' => json_encode([
        'Age: 18-45 years',
        'Weight: 45-80 kg',
        'Exceptional physical fitness',
        'Medical clearance',
        'Full commitment required',
        'Previous flying experience preferred',
        'Professional attitude'
    ]),
    'weather_dependent' => true,
    'advance_booking_required' => true,
    'cancellation_policy' => 'Flexible course scheduling. No refund policy due to extensive training involved.',
    'is_active' => true
]);

echo "✅ All paragliding packages created successfully!\n";
echo "📊 Total packages: " . App\Models\Package::count() . "\n";
echo "💰 Package price range: ₹" . App\Models\Package::min('price') . " - ₹" . App\Models\Package::max('price') . "\n";
