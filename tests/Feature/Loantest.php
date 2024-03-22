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
            'date_of_birth' => '1990-01-01'
            // other author fields here
        ]);

        $response->assertStatus(201);

        $authorId = $response->json('id');

        // Create book
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->postJson('/api/books', [
            'title' => 'Test book',
            'publication_year' => '2012',
            'authors' => [$authorId],
            // other book fields here
        ]);

        $response->assertStatus(201);

        $bookId = $response->json('id');

        // Create student
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->postJson('/api/students', [
            'name' => 'Test Student',
            'email' => $this->faker->unique()->safeEmail,
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
            'loan_date' => '2021-01-01',
            'return_date' => '2021-01-15'
            // other loan fields here
        ]);

        $response->assertStatus(201);
    }
}