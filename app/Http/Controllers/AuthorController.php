<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        return Author::all();
    }

    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'The name field is required.',
            'date_of_birth.required' => 'The date of birth field is required.',
            'date_of_birth.date' => 'The date of birth is not a valid date.',
        ];

        $request->validate([
            'name' => 'required',
            'date_of_birth' => 'required|date',
        ], $messages);

        return Author::create($request->all());
    }

    public function show(Author $author)
    {
        return $author;
    }

    public function update(Request $request, Author $author)
    {
        $messages = [
            'name.required' => 'The name field is required.',
            'date_of_birth.required' => 'The date of birth field is required.',
            'date_of_birth.date' => 'The date of birth is not a valid date.',
        ];

        $request->validate([
            'name' => 'required',
            'date_of_birth' => 'required|date',
        ], $messages);

        $author->update($request->all());

        return $author;
    }
}