<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

// Classe AuthorController que estende a classe Controller
class AuthorController extends Controller
{
    // Método para retornar todos os autores
    public function index()
    {
        return Author::all();
    }

    // Método para armazenar um novo autor
    public function store(Request $request)
    {
        // Mensagens de erro personalizadas
        $messages = [
            'name.required' => 'The name field is required.',
            'date_of_birth.required' => 'The date of birth field is required.',
            'date_of_birth.date' => 'The date of birth is not a valid date.',
        ];

        // Validação dos dados do request
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'date_of_birth' => 'required|date',
        ], $messages);

        // Se a validação falhar, retorna um erro 400 com as mensagens de erro
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Cria um novo autor com os dados do request e retorna o autor criado
        return Author::create($request->all());
    }

    // Método para mostrar um autor específico
    public function show(Author $author)
    {
        return $author;
    }

    // Método para atualizar um autor específico
    public function update(Request $request, Author $author)
    {
        // Mensagens de erro personalizadas
        $messages = [
            'name.required' => 'The name field is required.',
            'date_of_birth.required' => 'The date of birth field is required.',
            'date_of_birth.date' => 'The date of birth is not a valid date.',
        ];

        // Validação dos dados do request
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'date_of_birth' => 'required|date',
        ], $messages);

        // Se a validação falhar, retorna um erro 400 com as mensagens de erro
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Atualiza o autor com os dados do request e retorna o autor atualizado
        $author->update($request->all());

        return $author;
    }

    // Método para deletar um autor específico
    public function destroy(Author $author)
    {
        // Deleta o autor
        $author->delete();

        // Retorna uma resposta vazia com o código 204 (No Content)
        return response()->json(null, 204);
    }
}