<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Certificate;
use App\Models\Achievement;
use App\Models\FlightLog;
use App\Models\UserGallery;
use App\Models\User;
use Carbon\Carbon;

class SampleDataSeeder extends Seeder
{
    public function run()
    {
        // Get the first user or create one
        $user = User::first();
        
        if (!$user) {
            echo "No user found. Please create a user first.\n";
            return;
        }
        
        echo "Creating sample data for user: " . $user->name . "\n";
        
        // Create sample certificates if they don't exist
        if (Certificate::where('user_id', $user->id)->count() == 0) {
            Certificate::create([
                'user_id' => $user->id,
                'type' => 'pilot_license',
                'name' => 'Basic Pilot License',
                'certificate_number' => 'BPL-' . substr(md5(uniqid()), 0, 8),
                'issue_date' => Carbon::now()->subMonths(6),
                'expiry_date' => Carbon::now()->addYears(2),
                'issuing_authority' => 'National Paragliding Association',
                'verification_code' => strtoupper(substr(md5(uniqid()), 0, 8)),
                'status' => 'active',
                'metadata' => json_encode(['level' => 'basic'])
            ]);
            
            Certificate::create([
                'user_id' => $user->id,
                'type' => 'training',
                'name' => 'Advanced Thermal Flying',
                'certificate_number' => 'ATF-' . substr(md5(uniqid()), 0, 8),
                'issue_date' => Carbon::now()->subMonths(3),
                'expiry_date' => null,
                'issuing_authority' => 'Paragliding Training Center',
                'verification_code' => strtoupper(substr(md5(uniqid()), 0, 8)),
                'status' => 'active',
                'metadata' => json_encode(['hours' => 20])
            ]);
            echo "Created sample certificates\n";
        }
        
        // Create sample achievements if they don't exist
        $achievements = [
            [
                'name' => 'First Flight',
                'slug' => 'first-flight',
                'description' => 'Complete your first paragliding flight',
                'icon' => '🎯',
                'points' => 100,
                'category' => 'milestones',
                'criteria' => json_encode(['flights' => 1])
            ],
            [
                'name' => 'High Flyer',
                'slug' => 'high-flyer',
                'description' => 'Reach an altitude of 3000 meters',
                'icon' => '🏔️',
                'points' => 250,
                'category' => 'altitude',
                'criteria' => json_encode(['altitude' => 3000])
            ],
            [
                'name' => 'Century Club',
                'slug' => 'century-club',
                'description' => 'Complete 100 flights',
                'icon' => '💯',
                'points' => 500,
                'category' => 'milestones',
                'criteria' => json_encode(['flights' => 100])
            ]
        ];
        
        foreach ($achievements as $achievement) {
            Achievement::firstOrCreate(
                ['slug' => $achievement['slug']],
                $achievement
            );
        }
        echo "Created sample achievements\n";
        
        // Create sample flight logs if they don't exist
        if (FlightLog::where('user_id', $user->id)->count() == 0) {
            for ($i = 0; $i < 5; $i++) {
                $launchTime = Carbon::now()->subDays(rand(1, 30))->setHour(10)->setMinute(rand(0, 59));
                $landingTime = clone $launchTime;
                $landingTime->addMinutes(rand(30, 120));
                
                FlightLog::create([
                    'user_id' => $user->id,
                    'date' => $launchTime,
                    'site_name' => 'Hill Station ' . ($i + 1),
                    'launch_time' => $launchTime,
                    'landing_time' => $landingTime,
                    'flight_duration' => $launchTime->diffInMinutes($landingTime),
                    'max_altitude' => rand(500, 2500),
                    'distance' => rand(5, 50),
                    'glider_model' => 'Advance Alpha ' . rand(5, 7),
                    'weather_conditions' => 'Clear skies, thermal activity',
                    'wind_speed' => rand(10, 25) . ' km/h',
                    'wind_direction' => ['N', 'NE', 'E', 'SE', 'S', 'SW', 'W', 'NW'][rand(0, 7)],
                    'notes' => 'Great flying conditions today!',
                    'is_verified' => (bool)rand(0, 1),
                    'tags' => json_encode(['thermal', 'cross-country'])
                ]);
            }
            echo "Created sample flight logs\n";
        }
        
        // Attach some achievements to the user if not already attached
        $firstAchievement = Achievement::where('slug', 'first-flight')->first();
        if ($firstAchievement && !$user->achievements()->where('achievement_id', $firstAchievement->id)->exists()) {
            $user->achievements()->attach($firstAchievement->id, [
                'unlocked_at' => Carbon::now()->subDays(10),
                'progress' => 100,
                'metadata' => json_encode(['completed' => true])
            ]);
            echo "Attached achievement to user\n";
        }
        
        echo "Sample data created successfully!\n";
    }
}
