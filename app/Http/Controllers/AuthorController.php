<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'date_of_birth' => 'required|date',
        ], $messages);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

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

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'date_of_birth' => 'required|date',
        ], $messages);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $author->update($request->all());

        return $author;
    }

    public function destroy(Author $author)
    {
        $author->delete();

        return response()->json(null, 204);
    }
}