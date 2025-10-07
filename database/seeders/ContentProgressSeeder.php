<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ContentProgress;
use App\Models\User;
use App\Models\CourseContent;

class ContentProgressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get admin user (assuming first user is admin)
        $admin = User::first();
        if (!$admin) {
            $this->command->warn('No users found. Please run UserSeeder first.');
            return;
        }

        // Get some course contents
        $contents = CourseContent::take(5)->get();
        if ($contents->isEmpty()) {
            $this->command->warn('No course contents found. Please run CourseContentSeeder first.');
            return;
        }

        // Create some sample progress data
        foreach ($contents as $index => $content) {
            $isCompleted = $index < 3; // Mark first 3 as completed
            
            ContentProgress::create([
                'user_id' => $admin->id,
                'course_content_id' => $content->id,
                'is_completed' => $isCompleted,
                'completed_at' => $isCompleted ? now()->subDays(rand(1, 7)) : null,
                'time_spent' => rand(60, 1800), // 1-30 minutes in seconds
            ]);
        }

        $this->command->info('ContentProgressSeeder completed successfully!');
    }
}