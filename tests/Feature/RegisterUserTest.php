<?php
namespace Tests\Feature;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterUserTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_user()
    {
        $userData = User::factory()->make()->toArray();
        $userData['password'] = 'password'; // Set the password to match the one in the factory

        $response = $this->post('/register', $userData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('users', [
            'name' => $userData['name'],
            'email' => $userData['email'],
        ]);
    }
}