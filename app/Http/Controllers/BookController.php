<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function index()
    {
        return Book::with('authors')->get();
    }

    public function store(Request $request)
    {
        $messages = [
            'title.required' => 'The title field is required.',
            'publication_year.required' => 'The publication year field is required.',
            'publication_year.date_format' => 'The publication year must be a valid year.',
            'authors.required' => 'The authors field is required.',
            'authors.array' => 'The authors field must be an array.',
            'authors.*.exists' => 'One or more authors do not exist.',
        ];

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'publication_year' => 'required|date_format:Y',
            'authors' => 'required|array',
            'authors.*' => 'exists:authors,id',
        ], $messages);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $book = Book::create($request->only('title', 'publication_year'));

        $book->authors()->attach($request->input('authors'));

        return $book->load('authors');
    }

    public function show(Book $book)
    {
        return $book->load('authors');
    }

    public function update(Request $request, Book $book)
    {
        $messages = [
            'title.required' => 'The title field is required.',
            'publication_year.required' => 'The publication year field is required.',
            'publication_year.date_format' => 'The publication year must be a valid year.',
            'authors.required' => 'The authors field is required.',
            'authors.array' => 'The authors field must be an array.',
            'authors.*.exists' => 'One or more authors do not exist.',
        ];

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'publication_year' => 'required|date_format:Y',
            'authors' => 'required|array',
            'authors.*' => 'exists:authors,id',
        ], $messages);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $book->update($request->only('title', 'publication_year'));

        $book->authors()->sync($request->input('authors'));

        return $book->load('authors');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return response()->json(null, 204);
    }
}