<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail; 
use Illuminate\Http\Request;
use App\Mail\LoanCreated;
use App\Models\Loan;
use Illuminate\Support\Facades\Validator;

class LoanController extends Controller
{
    public function index()
    {
        return Loan::with(['student', 'book'])->get();
    }

    public function store(Request $request)
    {
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

        $validator = Validator::make($request->all(), [
            'student_id' => 'required|exists:students,id',
            'book_id' => 'required|exists:books,id',
            'loan_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:loan_date',
        ], $messages);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $loan = Loan::create($request->all());

        $student = Student::find($request->student_id);

        $studentEmail = $student->email;

        Mail::to($studentEmail)->queue(new LoanCreated($loan));
    
        return response()->json($loan, 201);
    }

    public function show(Loan $loan)
    {
        return $loan->load(['student', 'book']);
    }

    public function update(Request $request, Loan $loan)
    {
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

        $validator = Validator::make($request->all(), [
            'student_id' => 'required|exists:students,id',
            'book_id' => 'required|exists:books,id',
            'loan_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:loan_date',
        ], $messages);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $loan->update($request->all());

        return $loan;
    }

    public function destroy(Loan $loan)
    {
        $loan->delete();

        return response()->json(null, 204);
    }
}