<?php

namespace Tests\Unit;

use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    public function testLogin()
    {
        $user = User::factory()->create([
            'email' => 'test@test.com',
            'password' => bcrypt('password')
        ]);

        $response = $this->post('/api/auth/login', [
            'email' => 'test@test.com',
            'password' => 'password'
        ]);
        $response->assertStatus(201);
        $response->assertRedirect('/');
    }

    // Testing the User Refresh
    public function testRefresh()
    {
        $user = User::factory()->create([
            'email' => 'test@test.com',
            'password' => bcrypt('password')
        ]);
        $user = $this->post('/api/auth/login', [
            'email' => 'test@test.com',
            'password' => 'password'
        ]);

        $token = $user['original']['access_token'];

        $response = $this->withHeaders(['Authorization'=>'Bearer '.$token,
							    'Accept' => 'application/json'])
                    ->post ('/api/auth/refresh', []);

        $response->assertStatus(201);
}
}
