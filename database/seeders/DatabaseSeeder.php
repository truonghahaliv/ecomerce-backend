<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      //   User::factory(10)->create();

//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);
//        $this->call(ProductSeeder::class);
//
//        // Call the CategorySeeder
//        $this->call(CategorySeeder::class);
        Product::factory()->count(10)->create();

        // Generate 5 categories using the CategoryFactory
        Category::factory()->count(5)->create();
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
        ]);
    }
}
