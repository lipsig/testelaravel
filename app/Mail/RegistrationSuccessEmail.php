<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

// Classe RegistrationSuccessEmail que estende a classe Mailable
class RegistrationSuccessEmail extends Mailable
{
    // Traits para enfileirar e serializar modelos
    use Queueable, SerializesModels;

    // Propriedade pública para armazenar o usuário
    public $user;

    // Construtor da classe que recebe um usuário como parâmetro
    public function __construct($user)
    {
        // Atribui o usuário à propriedade $user
        $this->user = $user;
    }

    // Método para construir o email
    public function build()
    {
        // Retorna a view do email com os dados do usuário
        return $this->view('emails.registration_success')
                    ->with([
                        'name' => $this->user->name, // Nome do usuário
                    ]);
    }
}
?>