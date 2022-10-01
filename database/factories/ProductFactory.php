<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $users = User::create(['name'=>'tester', 'email'=>'tester@email.com','password'=>bcrypt('password')]);
        return [
            'title' => $this->faker->title,
            'price' => $this->faker->numberBetween($min = 500, $max = 8000),
            'is_active' => 1,
            'users_id' => User::all()->random()->id,
        ];
    }
}
