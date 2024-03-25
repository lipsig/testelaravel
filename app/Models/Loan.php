<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Classe Loan que estende a classe Model
class Loan extends Model
{
    // Trait para usar a factory do Laravel
    use HasFactory;

    // Propriedade protegida para definir os campos que podem ser preenchidos em massa
    protected $fillable = ['student_id', 'book_id', 'loan_date', 'return_date'];

    // Método para definir a relação entre empréstimo e estudante
    // Um empréstimo pertence a um estudante
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // Método para definir a relação entre empréstimo e livro
    // Um empréstimo pertence a um livro
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
?>