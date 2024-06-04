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
        //
        Category::create([
            'name' => 'Category 1',
            'description' => 'Description for Category 1',
        ]);

        Category::create([
            'name' => 'Category 2',
            'description' => 'Description for Category 2',
        ]);

    }
}
