<?php

namespace Database\Seeders;

use  App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->count(5)
            ->hasProducts(10)
            ->create();
        // \App\Models\User::factory(10)->create();
        // \App\Models\Product::factory(100)->create();
        // \App\Models\Category::factory(10)->create();
        // \App\Models\ProductCategory::factory(100)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
