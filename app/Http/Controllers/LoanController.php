<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Mail\LoanCreated;
use App\Models\Loan;
use App\Models\Student;

// Classe LoanController que estende a classe Controller
class LoanController extends Controller
{
    // Método para retornar todos os empréstimos com seus respectivos estudantes e livros
    public function index()
    {
        return Loan::with(['student', 'book'])->get();
    }

    // Método para armazenar um novo empréstimo
    public function store(Request $request)
    {
        // Mensagens de erro personalizadas
        $messages = [
            'student_id.required' => 'The student ID field is required.',
            'student_id.exists' => 'The selected student ID is invalid.',
            'book_id.required' => 'The book ID field is required.',
            'book_id.exists' => 'The selected book ID is invalid.',
            'loan_date.required' => 'The loan date field is required.',
            'loan_date.date' => 'The loan date is not a valid date.',
            'return_date.required' => 'The return date field is required.',
            'return_date.date' => 'The return date is not a valid date.',
            'return_date.after_or_equal' => 'The return date must be a date after or equal to the loan date.',
        ];

        // Validação dos dados do request
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|exists:students,id',
            'book_id' => 'required|exists:books,id',
            'loan_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:loan_date',
        ], $messages);

        // Se a validação falhar, retorna um erro 400 com as mensagens de erro
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Cria um novo empréstimo com os dados do request
        $loan = Loan::create($request->all());

        // Encontra o estudante pelo ID
        $student = Student::find($request->student_id);

        // Pega o email do estudante
        $studentEmail = $student->email;

        // Envia um email para o estudante informando sobre o empréstimo
        Mail::to($studentEmail)->queue(new LoanCreated($loan));
    
        // Retorna o empréstimo criado
        return response()->json($loan, 201);
    }

    // Método para mostrar um empréstimo específico com seu estudante e livro
    public function show(Loan $loan)
    {
        return $loan->load(['student', 'book']);
    }

    // Método para atualizar um empréstimo específico
    public function update(Request $request, Loan $loan)
    {
        // Mensagens de erro personalizadas
        $messages = [
            'student_id.required' => 'The student ID field is required.',
            'student_id.exists' => 'The selected student ID is invalid.',
            'book_id.required' => 'The book ID field is required.',
            'book_id.exists' => 'The selected book ID is invalid.',
            'loan_date.required' => 'The loan date field is required.',
            'loan_date.date' => 'The loan date is not a valid date.',
            'return_date.required' => 'The return date field is required.',
            'return_date.date' => 'The return date is not a valid date.',
            'return_date.after_or_equal' => 'The return date must be a date after or equal to the loan date.',
        ];

        // Validação dos dados do request
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|exists:students,id',
            'book_id' => 'required|exists:books,id',
            'loan_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:loan_date',
        ], $messages);

        // Se a validação falhar, retorna um erro 400 com as mensagens de erro
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Atualiza o empréstimo com os dados do request
        $loan->update($request->all());

        // Retorna o empréstimo atualizado
        return $loan;
    }

    // Método para deletar um empréstimo específico
    public function destroy(Loan $loan)
    {
        // Deleta o empréstimo
        $loan->delete();

        // Retorna uma resposta vazia com o código 204 (No Content)
        return response()->json(null, 204);
    }
}