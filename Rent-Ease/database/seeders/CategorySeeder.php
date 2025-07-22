<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    // Define your 6 categories with just their names
        $categoryNames = [
            'Electronics',
            'Kitchen Appliances',
            'Sports Equipment',
            'Tools',
            'Books',
            'Furniture',
        ];

        foreach ($categoryNames as $name) {
            Category::create([
                'name' => $name,
            ]);
        }       //
    }
}
