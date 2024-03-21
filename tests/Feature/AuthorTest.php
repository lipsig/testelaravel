<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthorTest extends TestCase
{
    /**
     * Test author creation.
     *
     * @return void
     */
    public function testCreateAuthor()
    {
        // Login and get JWT token
        $response = $this->postJson('/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(200);

        $token = $response->json('token');

        // Create author
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->postJson('/create', [
            'name' => 'Test Author',
            // other author fields here
        ]);

        $response->assertStatus(201);
    }
}