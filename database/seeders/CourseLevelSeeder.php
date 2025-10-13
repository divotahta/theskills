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
                'name' => 'Pemula',
                'slug' => 'pemula',
                'description' => 'Sempurna untuk pemula yang baru memulai. Tidak memerlukan pengalaman sebelumnya.',
                'sort_order' => 1,
                'color' => 'green',
                'is_active' => true,
            ],
            [
                'name' => 'Menengah',
                'slug' => 'menengah',
                'description' => 'Untuk pembelajar yang sudah memiliki pengetahuan dasar dan ingin meningkatkan keterampilan.',
                'sort_order' => 2,
                'color' => 'blue',
                'is_active' => true,
            ],
            [
                'name' => 'Lanjutan',
                'slug' => 'lanjutan',
                'description' => 'Untuk pembelajar berpengalaman yang ingin menguasai konsep dan teknik lanjutan.',
                'sort_order' => 3,
                'color' => 'red',
                'is_active' => true,
            ],
            [
                'name' => 'Expert',
                'slug' => 'expert',
                'description' => 'Untuk profesional dan ahli yang ingin tetap update dengan tren terbaru.',
                'sort_order' => 4,
                'color' => 'purple',
                'is_active' => true,
            ],
            [
                'name' => 'Semua Level',
                'slug' => 'semua-level',
                'description' => 'Cocok untuk pembelajar dari semua tingkat keterampilan, dari pemula hingga expert.',
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