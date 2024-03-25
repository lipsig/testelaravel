<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

// Classe StudentController que estende a classe Controller
class StudentController extends Controller
{
    // Método para retornar todos os estudantes
    public function index()
    {
        return Student::all();
    }

    // Método para armazenar um novo estudante
    public function store(Request $request)
    {
        // Mensagens de erro personalizadas
        $messages = [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',
        ];

        // Validação dos dados do request
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:students',
        ], $messages);

        // Se a validação falhar, retorna um erro 400 com as mensagens de erro
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Cria um novo estudante com os dados do request
        return Student::create($request->all());
    }

    // Método para mostrar um estudante específico
    public function show(Student $student)
    {
        return $student;
    }

    // Método para atualizar um estudante específico
    public function update(Request $request, Student $student)
    {
        // Mensagens de erro personalizadas
        $messages = [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',
        ];

        // Validação dos dados do request
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:students,email,' . $student->id,
        ], $messages);

        // Se a validação falhar, retorna um erro 400 com as mensagens de erro
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Atualiza o estudante com os dados do request
        $student->update($request->all());

        // Retorna o estudante atualizado
        return $student;
    }

    // Método para deletar um estudante específico
    public function destroy(Student $student)
    {
        // Deleta o estudante
        $student->delete();

        // Retorna uma resposta vazia com o código 204 (No Content)
        return response()->json(null, 204);
    }
}