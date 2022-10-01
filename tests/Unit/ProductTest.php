<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\User;
use App\Models\Product;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    private $product;
    private $token;

    public function setup(): void
    {
        parent::setup();

        $this->product = Product::factory()->create();
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

    // Test all Products Route
    public function testProductsRoute()
    {
        $response = $this->withHeaders(['Authorization'=>'Bearer '.$this->token,
							    'Accept' => 'application/json'])
                        ->get('/api/products');
        $response->assertStatus(200);
    }

    // Test get Single ProductRoute
    public function testProductSingle()
    {
        $response = $this->withHeaders(['Authorization'=>'Bearer '.$this->token,
							    'Accept' => 'application/json'])
                        ->get('/api/products/view/'.$this->product->id);

        $response->assertStatus(200);
    }

    // Test Product Delete
    public function testProductDelete()
    {
        $response = $this->withHeaders(['Authorization'=>'Bearer '.$this->token,
							    'Accept' => 'application/json'])
                        ->post('/api/products/delete/'.$this->product->id);
        $response->assertStatus(200);
    }

    //Test Products Not Empty
    public function testProductsNotEmpty()
    {
        $response = $this->withHeaders(['Authorization'=>'Bearer '.$this->token,
                    'Accept' => 'application/json'])
                    ->get('/api/products');
        $response->assertSee($this->product->title);
    }

    // Test Product Title
    public function testProductTitle()
    {
        $this->assertNotEmpty($this->product->title);
    }

    // Test Product price
    public function testProductPrice()
    {
        $this->assertNotEmpty($this->product->price);
    }

    // Test Product User
    public function testProductUser()
    {
        $this->assertNotEmpty($this->product->users_id);
    }
}
