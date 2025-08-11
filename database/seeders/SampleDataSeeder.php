<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Package;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Testimonial;
use App\Models\Gallery;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class SampleDataSeeder extends Seeder
{
    public function run()
    {
        $this->command->info('🚀 Starting sample data seeding...');

        // Create Admin User
        $this->command->info('👤 Creating admin user...');
        User::updateOrCreate(
            ['email' => 'admin@birbilling.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'phone' => '9876543210',
                'address' => 'Bir, Kangra, Himachal Pradesh'
            ]
        );

        // Create Customer Users
        $this->command->info('👥 Creating customer users...');
        $customers = [
            [
                'name' => 'Priya Sharma',
                'email' => 'priya@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'customer',
                'phone' => '9876543211',
                'address' => 'Delhi, India'
            ],
            [
                'name' => 'Rahul Kumar',
                'email' => 'rahul@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'customer',
                'phone' => '9876543212',
                'address' => 'Mumbai, India'
            ],
            [
                'name' => 'Anjali Singh',
                'email' => 'anjali@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'customer',
                'phone' => '9876543213',
                'address' => 'Bangalore, India'
            ]
        ];

        foreach ($customers as $customer) {
            User::updateOrCreate(
                ['email' => $customer['email']],
                $customer
            );
        }

        // Create Packages
        $this->command->info('📦 Creating packages...');
        $packages = [
            [
                'name' => 'Paragliding Adventure',
                'slug' => 'paragliding-adventure',
                'description' => 'Experience the thrill of paragliding over the beautiful valleys of Bir Billing.',
                'short_description' => 'Tandem paragliding flight with certified instructor',
                'price' => 2500.00,
                'duration' => '2-3 hours',
                'max_people' => 1,
                'location' => 'Bir Billing, Himachal Pradesh',
                'includes' => 'Professional instructor, Safety equipment, Photography, Certificate',
                'excludes' => 'Transportation, Food, Personal expenses',
                'image_path' => 'images/packages/paragliding-adventure.jpg',
                'gallery_images' => json_encode([
                    'images/packages/paragliding-1.jpg',
                    'images/packages/paragliding-2.jpg'
                ]),
                'is_featured' => true,
                'status' => 'active'
            ],
            [
                'name' => 'Camping Under Stars',
                'slug' => 'camping-under-stars',
                'description' => 'Spend a night under the starlit sky with comfortable camping arrangements.',
                'short_description' => 'Overnight camping experience with bonfire',
                'price' => 1200.00,
                'duration' => '1 night, 2 days',
                'max_people' => 4,
                'location' => 'Bir, Himachal Pradesh',
                'includes' => 'Tent accommodation, Meals, Bonfire, Local guide',
                'excludes' => 'Transportation, Alcohol, Personal expenses',
                'image_path' => 'images/packages/camping.jpg',
                'gallery_images' => json_encode([
                    'images/packages/camping-1.jpg',
                    'images/packages/camping-2.jpg'
                ]),
                'is_featured' => false,
                'status' => 'active'
            ],
            [
                'name' => 'Trekking Expedition',
                'slug' => 'trekking-expedition',
                'description' => 'Explore the scenic trails around Bir with our experienced guides.',
                'short_description' => 'Guided trekking through mountain trails',
                'price' => 800.00,
                'duration' => '6-8 hours',
                'max_people' => 8,
                'location' => 'Bir Billing Region',
                'includes' => 'Professional guide, First aid kit, Refreshments',
                'excludes' => 'Trekking gear, Transportation, Meals',
                'image_path' => 'images/packages/trekking.jpg',
                'gallery_images' => json_encode([
                    'images/packages/trekking-1.jpg'
                ]),
                'is_featured' => true,
                'status' => 'active'
            ]
        ];

        foreach ($packages as $package) {
            Package::updateOrCreate(
                ['slug' => $package['slug']],
                $package
            );
        }

        // Get created records
        $priyaUser = User::where('email', 'priya@gmail.com')->first();
        $rahulUser = User::where('email', 'rahul@gmail.com')->first();
        $anjaliUser = User::where('email', 'anjali@gmail.com')->first();
        
        $paraglidingPackage = Package::where('slug', 'paragliding-adventure')->first();
        $campingPackage = Package::where('slug', 'camping-under-stars')->first();
        $trekkingPackage = Package::where('slug', 'trekking-expedition')->first();

        // Create Bookings
        $this->command->info('🎫 Creating bookings...');
        
        // Prepare booking data based on available columns
        $bookingColumns = Schema::getColumnListing('bookings');
        $bookingsData = [
            [
                'booking_number' => 'BB2025001',
                'user_id' => $priyaUser->id,
                'package_id' => $paraglidingPackage->id,
                'booking_date' => '2025-08-15',
                'number_of_people' => 1,
                'total_amount' => 2500.00,
                'status' => 'confirmed',
                'special_requests' => 'First time paragliding'
            ],
            [
                'booking_number' => 'BB2025002',
                'user_id' => $rahulUser->id,
                'package_id' => $campingPackage->id,
                'booking_date' => '2025-08-20',
                'number_of_people' => 2,
                'total_amount' => 2400.00,
                'status' => 'confirmed',
                'special_requests' => 'Vegetarian meals preferred'
            ],
            [
                'booking_number' => 'BB2025003',
                'user_id' => $anjaliUser->id,
                'package_id' => $trekkingPackage->id,
                'booking_date' => '2025-08-25',
                'number_of_people' => 1,
                'total_amount' => 800.00,
                'status' => 'pending',
                'special_requests' => 'Need beginner-friendly route'
            ]
        ];

        foreach ($bookingsData as $bookingData) {
            // Add conditional fields based on table structure
            if (in_array('participants', $bookingColumns)) {
                $bookingData['participants'] = $bookingData['number_of_people'];
            }
            if (in_array('final_amount', $bookingColumns)) {
                $bookingData['final_amount'] = $bookingData['total_amount'];
            }
            if (in_array('discount_amount', $bookingColumns)) {
                $bookingData['discount_amount'] = 0;
            }
            if (in_array('participant_details', $bookingColumns)) {
                $bookingData['participant_details'] = json_encode([
                    ['name' => 'Sample Participant', 'age' => 25, 'phone' => '9876543210']
                ]);
            }
            if (in_array('emergency_contact', $bookingColumns)) {
                $bookingData['emergency_contact'] = json_encode([
                    'name' => 'Emergency Contact', 
                    'phone' => '9876543200', 
                    'relation' => 'Family'
                ]);
            }
            if (in_array('emergency_phone', $bookingColumns)) {
                $bookingData['emergency_phone'] = '9876543200';
            }
            if (in_array('medical_conditions', $bookingColumns)) {
                $bookingData['medical_conditions'] = null;
            }
            if (in_array('booking_status', $bookingColumns)) {
                $bookingData['booking_status'] = 'active';
            }
            if (in_array('payment_status', $bookingColumns)) {
                $bookingData['payment_status'] = 'pending';
            }

            Booking::updateOrCreate(
                ['booking_number' => $bookingData['booking_number']],
                $bookingData
            );
        }

        // Create Payments
        $this->command->info('💳 Creating payments...');
        $paymentColumns = Schema::getColumnListing('payments');
        $bookings = Booking::all();

        foreach ($bookings as $booking) {
            $paymentData = [
                'booking_id' => $booking->id,
                'amount' => $booking->total_amount ?? $booking->final_amount ?? 1000,
            ];

            // Add conditional fields based on payments table structure
            if (in_array('payment_method', $paymentColumns)) {
                $paymentData['payment_method'] = 'razorpay';
            }
            if (in_array('transaction_id', $paymentColumns)) {
                $paymentData['transaction_id'] = 'razorpay_' . uniqid();
            }
            if (in_array('status', $paymentColumns)) {
                // Use 'pending' instead of 'completed' to avoid enum issues
                $paymentData['status'] = 'pending';
            }
            // Use 'paid_at' instead of 'payment_date' (based on your table structure)
            if (in_array('paid_at', $paymentColumns)) {
                $paymentData['paid_at'] = $booking->status === 'confirmed' ? now() : null;
            }
            if (in_array('payment_date', $paymentColumns)) {
                $paymentData['payment_date'] = $booking->status === 'confirmed' ? now() : null;
            }
            if (in_array('currency', $paymentColumns)) {
                $paymentData['currency'] = 'INR';
            }
            if (in_array('payment_id', $paymentColumns)) {
                $paymentData['payment_id'] = 'pay_' . uniqid();
            }
            if (in_array('order_id', $paymentColumns)) {
                $paymentData['order_id'] = 'order_' . uniqid();
            }

            Payment::updateOrCreate(
                ['booking_id' => $booking->id],
                $paymentData
            );
        }

        // Create Testimonials
        $this->command->info('⭐ Creating testimonials...');
        $testimonialColumns = Schema::getColumnListing('testimonials');
        
        $testimonialsData = [
            [
                'customer_name' => 'Priya Sharma',
                'review' => 'Amazing paragliding experience! Highly recommended.',
                'rating' => 5
            ],
            [
                'customer_name' => 'Ravi Gupta',
                'review' => 'Great camping experience with beautiful bonfire night.',
                'rating' => 5
            ]
        ];

        foreach ($testimonialsData as $testimonialData) {
            if (in_array('status', $testimonialColumns)) {
                $testimonialData['status'] = 'approved';
            }
            if (in_array('is_approved', $testimonialColumns)) {
                $testimonialData['is_approved'] = true;
            }

            Testimonial::updateOrCreate(
                ['customer_name' => $testimonialData['customer_name']],
                $testimonialData
            );
        }

        // Create Gallery
        $this->command->info('🖼️ Creating gallery...');
        $galleryColumns = Schema::getColumnListing('galleries');
        
        $galleryItems = [
            [
                'title' => 'Paragliding Over Valley',
                'description' => 'Spectacular view of paragliding over the valleys',
                'image_path' => 'images/gallery/paragliding-valley.jpg'
            ],
            [
                'title' => 'Camping Bonfire',
                'description' => 'Cozy bonfire night during camping',
                'image_path' => 'images/gallery/camping-bonfire.jpg'
            ],
            [
                'title' => 'Mountain Trek',
                'description' => 'Beautiful trekking trail through mountains',
                'image_path' => 'images/gallery/trekking-trail.jpg'
            ]
        ];

        foreach ($galleryItems as $item) {
            // Add conditional fields for gallery
            if (in_array('image_alt', $galleryColumns)) {
                $item['image_alt'] = $item['title'];
            }
            if (in_array('category', $galleryColumns)) {
                $item['category'] = 'adventure';
            }
            if (in_array('package_id', $galleryColumns)) {
                $item['package_id'] = $paraglidingPackage->id;
            }
            if (in_array('sort_order', $galleryColumns)) {
                $item['sort_order'] = 1;
            }
            if (in_array('is_featured', $galleryColumns)) {
                $item['is_featured'] = true;
            }

            Gallery::updateOrCreate(
                ['title' => $item['title']],
                $item
            );
        }

        $this->command->info('✅ Sample data seeded successfully!');
        $this->command->info('🔑 Admin login: admin@birbilling.com / admin123');
        $this->command->info('👤 Customer login: priya@gmail.com / password123');
    }
}
