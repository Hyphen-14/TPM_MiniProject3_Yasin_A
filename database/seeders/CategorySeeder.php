<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Adventure', 'description' => 'Kategori untuk petualangan seru'],
            ['name' => 'Relaxing', 'description' => 'Kategori untuk bersantai'],
            ['name' => 'Historical', 'description' => 'Kategori untuk tempat bersejarah'],
            ['name' => 'Nature', 'description' => 'Kategori untuk destinasi alam'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
