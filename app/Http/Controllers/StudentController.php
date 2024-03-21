<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return Student::all();
    }

    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',
        ];

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students',
        ], $messages);

        return Student::create($request->all());
    }

    public function show(Student $student)
    {
        return $student;
    }

    public function update(Request $request, Student $student)
    {
        $messages = [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',
        ];

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students,email,' . $student->id,
        ], $messages);

        $student->update($request->all());

        return $student;
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return response()->json(null, 204);
    }
}