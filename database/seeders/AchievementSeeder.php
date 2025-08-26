<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Achievement;

class AchievementSeeder extends Seeder
{
    public function run()
    {
        $achievements = [
            // Flight Hours Achievements
            [
                'name' => 'First Flight',
                'slug' => 'first_flight',
                'description' => 'Complete your first paragliding flight',
                'icon' => '🎯',
                'points' => 100,
                'category' => 'flight_hours',
                'criteria' => json_encode(['type' => 'flight_count', 'required' => 1])
            ],
            [
                'name' => 'Sky Explorer',
                'slug' => 'sky_explorer',
                'description' => 'Complete 10 flights',
                'icon' => '✈️',
                'points' => 250,
                'category' => 'flight_hours',
                'criteria' => json_encode(['type' => 'flight_count', 'required' => 10])
            ],
            [
                'name' => 'Century Pilot',
                'slug' => 'century_pilot',
                'description' => 'Complete 100 flight hours',
                'icon' => '⏰',
                'points' => 1000,
                'category' => 'flight_hours',
                'criteria' => json_encode(['type' => 'flight_hours', 'required' => 100])
            ],
            
            // Skill Achievements
            [
                'name' => 'Beginner Pilot',
                'slug' => 'beginner_pilot',
                'description' => 'Earn your P1 certificate',
                'icon' => '🎓',
                'points' => 500,
                'category' => 'skills',
                'criteria' => json_encode(['type' => 'certificate', 'required' => 'P1'])
            ],
            [
                'name' => 'Intermediate Pilot',
                'slug' => 'intermediate_pilot',
                'description' => 'Earn your P2 certificate',
                'icon' => '🏆',
                'points' => 750,
                'category' => 'skills',
                'criteria' => json_encode(['type' => 'certificate', 'required' => 'P2'])
            ],
            [
                'name' => 'Advanced Pilot',
                'slug' => 'advanced_pilot',
                'description' => 'Earn your P3 certificate',
                'icon' => '🥇',
                'points' => 1000,
                'category' => 'skills',
                'criteria' => json_encode(['type' => 'certificate', 'required' => 'P3'])
            ],
            [
                'name' => 'Expert Pilot',
                'slug' => 'expert_pilot',
                'description' => 'Earn your P4 certificate',
                'icon' => '👑',
                'points' => 1500,
                'category' => 'skills',
                'criteria' => json_encode(['type' => 'certificate', 'required' => 'P4'])
            ],
            
            // Altitude Achievements
            [
                'name' => 'Cloud Walker',
                'slug' => 'cloud_walker',
                'description' => 'Reach 3000m altitude',
                'icon' => '☁️',
                'points' => 500,
                'category' => 'altitude',
                'criteria' => json_encode(['type' => 'altitude', 'required' => 3000])
            ],
            [
                'name' => 'Mountain Master',
                'slug' => 'mountain_master',
                'description' => 'Reach 4000m altitude',
                'icon' => '🏔️',
                'points' => 750,
                'category' => 'altitude',
                'criteria' => json_encode(['type' => 'altitude', 'required' => 4000])
            ],
            
            // Social Achievements
            [
                'name' => 'First Upload',
                'slug' => 'first_upload',
                'description' => 'Upload your first photo or video',
                'icon' => '📸',
                'points' => 50,
                'category' => 'social',
                'criteria' => json_encode(['type' => 'gallery', 'required' => 1])
            ],
            [
                'name' => 'Gallery Enthusiast',
                'slug' => 'gallery_enthusiast',
                'description' => 'Upload 10 photos or videos',
                'icon' => '🖼️',
                'points' => 200,
                'category' => 'social',
                'criteria' => json_encode(['type' => 'gallery', 'required' => 10])
            ]
        ];

        foreach ($achievements as $achievement) {
            Achievement::create($achievement);
        }
    }
}
