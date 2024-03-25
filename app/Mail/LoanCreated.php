<?php

namespace App\Mail;

use App\Models\Loan;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

// Classe LoanCreated que estende a classe Mailable
class LoanCreated extends Mailable
{
    // Traits para enfileirar e serializar modelos
    use Queueable, SerializesModels;

    // Propriedade pública para armazenar o empréstimo
    public $loan;

    // Construtor da classe que recebe um empréstimo como parâmetro
    public function __construct(Loan $loan)
    {
        // Atribui o empréstimo à propriedade $loan
        $this->loan = $loan;
    }

    // Método para construir o email
    public function build()
    {
        // Retorna a view do email com os dados do empréstimo
        return $this->view('emails.loan_created')
                    ->with([
                        'loanId' => $this->loan->id, // ID do empréstimo
                        'bookTitle' => $this->loan->book->title, // Título do livro
                        'studentName' => $this->loan->student->name, // Nome do estudante
                    ]);
    }
}