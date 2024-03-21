<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index()
    {
        return Loan::with(['user', 'book'])->get();
    }

    public function store(Request $request)
    {
        $messages = [
            'user_id.required' => 'The user ID field is required.',
            'user_id.exists' => 'The selected user ID is invalid.',
            'book_id.required' => 'The book ID field is required.',
            'book_id.exists' => 'The selected book ID is invalid.',
            'loan_date.required' => 'The loan date field is required.',
            'loan_date.date' => 'The loan date is not a valid date.',
            'return_date.required' => 'The return date field is required.',
            'return_date.date' => 'The return date is not a valid date.',
            'return_date.after_or_equal' => 'The return date must be a date after or equal to the loan date.',
        ];

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'loan_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:loan_date',
        ], $messages);

        return Loan::create($request->all());
    }

    public function show(Loan $loan)
    {
        return $loan->load(['user', 'book']);
    }
}