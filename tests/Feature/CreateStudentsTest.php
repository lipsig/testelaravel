<?php
namespace Tests\Feature;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateStudentsTest extends TestCase
{
    use RefreshDatabase;

    public function test_register()
    {
        $studentData = Student::factory()->make()->toArray();

        $response = $this->post('/api/students', $studentData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('students', $studentData);
    }
}