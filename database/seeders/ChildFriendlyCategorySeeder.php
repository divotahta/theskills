<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class ChildFriendlyCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Coding & Programming',
                'slug' => 'coding-programming',
                'description' => 'Belajar coding dengan cara yang menyenangkan untuk anak-anak',
                'icon' => '💻',
                'color' => 'blue',
                'is_active' => true,
            ],
            [
                'name' => 'Matematika Seru',
                'slug' => 'matematika-seru',
                'description' => 'Matematika dasar dengan permainan dan aktivitas menarik',
                'icon' => '🔢',
                'color' => 'green',
                'is_active' => true,
            ],
            [
                'name' => 'Eksperimen Sains',
                'slug' => 'eksperimen-sains',
                'description' => 'Eksperimen sains sederhana dan aman untuk anak-anak',
                'icon' => '🧪',
                'color' => 'purple',
                'is_active' => true,
            ],
            [
                'name' => 'Public Speaking',
                'slug' => 'public-speaking',
                'description' => 'Mengembangkan kepercayaan diri dan kemampuan berbicara di depan umum',
                'icon' => '🎤',
                'color' => 'red',
                'is_active' => true,
            ],
            [
                'name' => 'Seni & Kreativitas',
                'slug' => 'seni-kreativitas',
                'description' => 'Menggambar, melukis, dan berbagai aktivitas seni kreatif',
                'icon' => '🎨',
                'color' => 'pink',
                'is_active' => true,
            ],
            [
                'name' => 'Bahasa Inggris',
                'slug' => 'bahasa-inggris',
                'description' => 'Belajar bahasa Inggris dengan metode yang menyenangkan',
                'icon' => '🇬🇧',
                'color' => 'yellow',
                'is_active' => true,
            ],
            [
                'name' => 'Musik & Tari',
                'slug' => 'musik-tari',
                'description' => 'Mengembangkan bakat musik dan tarian anak-anak',
                'icon' => '🎵',
                'color' => 'indigo',
                'is_active' => true,
            ],
            [
                'name' => 'Olahraga & Kebugaran',
                'slug' => 'olahraga-kebugaran',
                'description' => 'Aktivitas fisik yang menyenangkan dan sehat untuk anak-anak',
                'icon' => '⚽',
                'color' => 'orange',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $categoryData) {
            Category::updateOrCreate(
                ['slug' => $categoryData['slug']],
                $categoryData
            );
        }
    }
}
