<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

// Classe BookController que estende a classe Controller
class BookController extends Controller
{
    // Método para retornar todos os livros com seus respectivos autores
    public function index()
    {
        return Book::with('authors')->get();
    }

    // Método para armazenar um novo livro
    public function store(Request $request)
    {
        // Mensagens de erro personalizadas
        $messages = [
            'title.required' => 'The title field is required.',
            'publication_year.required' => 'The publication year field is required.',
            'publication_year.date_format' => 'The publication year must be a valid year.',
            'authors.required' => 'The authors field is required.',
            'authors.array' => 'The authors field must be an array.',
            'authors.*.exists' => 'One or more authors do not exist.',
        ];

        // Validação dos dados do request
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'publication_year' => 'required|date_format:Y',
            'authors' => 'required|array',
            'authors.*' => 'exists:authors,id',
        ], $messages);

        // Se a validação falhar, retorna um erro 400 com as mensagens de erro
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Cria um novo livro com os dados do request
        $book = Book::create($request->only('title', 'publication_year'));

        // Associa os autores ao livro
        $book->authors()->attach($request->input('authors'));

        // Retorna o livro criado com seus autores
        return $book->load('authors');
    }

    // Método para mostrar um livro específico com seus autores
    public function show(Book $book)
    {
        return $book->load('authors');
    }

    // Método para atualizar um livro específico
    public function update(Request $request, Book $book)
    {
        // Mensagens de erro personalizadas
        $messages = [
            'title.required' => 'The title field is required.',
            'publication_year.required' => 'The publication year field is required.',
            'publication_year.date_format' => 'The publication year must be a valid year.',
            'authors.required' => 'The authors field is required.',
            'authors.array' => 'The authors field must be an array.',
            'authors.*.exists' => 'One or more authors do not exist.',
        ];

        // Validação dos dados do request
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'publication_year' => 'required|date_format:Y',
            'authors' => 'required|array',
            'authors.*' => 'exists:authors,id',
        ], $messages);

        // Se a validação falhar, retorna um erro 400 com as mensagens de erro
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Atualiza o livro com os dados do request
        $book->update($request->only('title', 'publication_year'));

        // Sincroniza os autores do livro
        $book->authors()->sync($request->input('authors'));

        // Retorna o livro atualizado com seus autores
        return $book->load('authors');
    }

    // Método para deletar um livro específico
    public function destroy(Book $book)
    {
        // Deleta o livro
        $book->delete();

        // Retorna uma resposta vazia com o código 204 (No Content)
        return response()->json(null, 204);
    }
}