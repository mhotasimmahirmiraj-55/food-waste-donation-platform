<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FoodCategory;

class FoodCategorySeeder extends Seeder
{
    public function run(): void
    {
        FoodCategory::create([
            'name' => 'Rice'
        ]);

        FoodCategory::create([
            'name' => 'Vegetables'
        ]);

        FoodCategory::create([
            'name' => 'Fruits'
        ]);

        FoodCategory::create([
            'name' => 'Fast Food'
        ]);
    }
}