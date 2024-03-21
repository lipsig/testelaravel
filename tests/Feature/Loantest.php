<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoanTest extends TestCase
{
    /**
     * Test loan creation.
     *
     * @return void
     */
    public function testCreateLoan()
    {
        // Login and get JWT token
        $response = $this->postJson('/api/login', [
            'email' => 'admin@example.com',
            'password' => 'Test1234!',
        ]);

        $response->assertStatus(200);

        $token = $response->json('token');

        // Create author
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->postJson('/api/authors', [
            'name' => 'Test Author',
            // other author fields here
        ]);

        $response->assertStatus(201);

        $authorId = $response->json('id');

        // Create book
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->postJson('/api/books', [
            'title' => 'Test Book',
            'author_id' => $authorId,
            // other book fields here
        ]);

        $response->assertStatus(201);

        $bookId = $response->json('id');

        // Create student
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->postJson('/api/students', [
            'name' => 'Test Student',
            // other student fields here
        ]);

        $response->assertStatus(201);

        $studentId = $response->json('id');

        // Create loan
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->postJson('/api/loans', [
            'book_id' => $bookId,
            'student_id' => $studentId,
            // other loan fields here
        ]);

        $response->assertStatus(201);
    }
}