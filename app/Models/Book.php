<?php
// Inicia um bloco de código PHP

namespace App\Models;
// Define o namespace para o arquivo atual. Isso é usado para evitar conflitos de nomes entre classes.

use Illuminate\Database\Eloquent\Factories\HasFactory;
// Importa a trait HasFactory do namespace Illuminate\Database\Eloquent\Factories. 
// Esta trait permite que a classe use factories para criar instâncias para testes.

use Illuminate\Database\Eloquent\Model;
// Importa a classe Model do namespace Illuminate\Database\Eloquent. 
// Esta é a classe base para todos os modelos Eloquent.

class Book extends Model
// Define uma nova classe chamada Book que estende a classe Model. 
// Isso significa que Book é um modelo Eloquent e pode usar todos os métodos e propriedades de Model.

{
    use HasFactory;
    // Inclui a trait HasFactory na classe Book. 
    // Isso permite que a classe Book use o método factory() para criar instâncias para testes.

    protected $fillable = ['title', 'publication_year'];
    // Define a propriedade $fillable na classe Book. 
    // Esta propriedade é usada pelo Eloquent para saber quais campos podem ser preenchidos em massa.

    public function authors()
    // Define um método chamado authors na classe Book.

    {
        return $this->belongsToMany(Author::class);
        // Este método retorna a relação entre o livro e os autores. 
        // A relação é definida usando o método belongsToMany(), que indica que um livro pode pertencer a muitos autores.
    }
}