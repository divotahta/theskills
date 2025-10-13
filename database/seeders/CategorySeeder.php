<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Matematika',
                'slug' => 'matematika',
                'description' => 'Kursus matematika dari dasar hingga advanced untuk semua level',
                'icon' => 'calculator',
                'color' => 'blue',
                'is_active' => true,
            ],
            [
                'name' => 'Koding & Programming',
                'slug' => 'koding-programming',
                'description' => 'Belajar programming dan koding dari pemula hingga mahir',
                'icon' => 'code',
                'color' => 'green',
                'is_active' => true,
            ],
            [
                'name' => 'Mewarnai & Seni',
                'slug' => 'mewarnai-seni',
                'description' => 'Kursus mewarnai dan seni kreatif untuk semua usia',
                'icon' => 'palette',
                'color' => 'purple',
                'is_active' => true,
            ],
            [
                'name' => 'Public Speaking',
                'slug' => 'public-speaking',
                'description' => 'Kursus public speaking dan komunikasi efektif',
                'icon' => 'microphone',
                'color' => 'red',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
} 