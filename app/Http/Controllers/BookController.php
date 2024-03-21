<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return Book::with('authors')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'publication_year' => 'required|date_format:Y',
            'authors' => 'required|array',
            'authors.*' => 'exists:authors,id',
        ]);

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
        $request->validate([
            'title' => 'required',
            'publication_year' => 'required|date_format:Y',
            'authors' => 'required|array',
            'authors.*' => 'exists:authors,id',
        ]);

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