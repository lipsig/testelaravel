<?php

namespace App\Mail;

use App\Models\Loan;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LoanCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $loan;

    public function __construct(Loan $loan)
    {
        $this->loan = $loan;
    }

    public function build()
    {
        return $this->view('emails.loan_created')
                    ->with([
                        'loanId' => $this->loan->id,
                        'bookTitle' => $this->loan->book->title,
                        'studentName' => $this->loan->student->name,
                    ]);
    }
}