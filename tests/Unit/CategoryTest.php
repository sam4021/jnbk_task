<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\User;
use App\Models\Category;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    private $category;
    private $token;

    public function setup(): void
    {
        parent::setup();

        $this->category = Category::factory()->create();
        $user = User::factory()->create([
            'email' => 'test@test.com',
            'password' => bcrypt('password')
        ]);
        $user = $this->post('/api/auth/login', [
            'email' => 'test@test.com',
            'password' => 'password'
        ]);

        $this->token = $user['original']['access_token'];
    }

    // Test all Category's Route
    public function testCategoriesRoute()
    {
        $response = $this->withHeaders(['Authorization'=>'Bearer '.$this->token,
							    'Accept' => 'application/json'])
                        ->get('/api/category');
        $response->assertStatus(200);
    }

    // Test get Single CategoryRoute
    public function testCategorySingle()
    {
        $response = $this->withHeaders(['Authorization'=>'Bearer '.$this->token,
							    'Accept' => 'application/json'])
                        ->get('/api/category/view/'.$this->category->id);

        $response->assertStatus(200);
    }

    //Test Category Not Empty
    public function testCategoryNotEmpty()
    {
        $response = $this->withHeaders(['Authorization'=>'Bearer '.$this->token,
                    'Accept' => 'application/json'])
                    ->get('/api/category');
        $response->assertSee($this->category->title);
    }

    // Test Category Title
    public function testCategoryTitle()
    {
        $this->assertNotEmpty($this->category->title);
    }

    // Test Category Delete
    public function testCategoryDelete()
    {
        $response = $this->withHeaders(['Authorization'=>'Bearer '.$this->token,
							    'Accept' => 'application/json'])
                        ->post('/api/category/delete/'.$this->category->id);
        $response->assertStatus(200);
    }
}
