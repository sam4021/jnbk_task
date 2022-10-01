<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $users = User::create(['name'=>'tester', 'email'=>'tester@email.com','password'=>bcrypt('password')]);
        return [
            'title' => fake()->word(),
            'is_active' => 1,
            'users_id' => User::all()->random()->id
        ];
    }
}
