<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CourseLevel;

class CourseLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courseLevels = [
            [
                'name' => 'Beginner',
                'slug' => 'beginner',
                'description' => 'Perfect for those who are new to the subject. No prior experience required.',
                'sort_order' => 1,
                'color' => 'green',
                'is_active' => true,
            ],
            [
                'name' => 'Intermediate',
                'slug' => 'intermediate',
                'description' => 'For learners with some basic knowledge who want to advance their skills.',
                'sort_order' => 2,
                'color' => 'blue',
                'is_active' => true,
            ],
            [
                'name' => 'Advanced',
                'slug' => 'advanced',
                'description' => 'For experienced learners who want to master advanced concepts and techniques.',
                'sort_order' => 3,
                'color' => 'red',
                'is_active' => true,
            ],
            [
                'name' => 'Expert',
                'slug' => 'expert',
                'description' => 'For professionals and experts who want to stay updated with the latest trends.',
                'sort_order' => 4,
                'color' => 'purple',
                'is_active' => true,
            ],
            [
                'name' => 'All Levels',
                'slug' => 'all-levels',
                'description' => 'Suitable for learners of all skill levels, from beginner to expert.',
                'sort_order' => 0,
                'color' => 'gray',
                'is_active' => true,
            ],
        ];

        foreach ($courseLevels as $level) {
            CourseLevel::create($level);
        }
    }
}