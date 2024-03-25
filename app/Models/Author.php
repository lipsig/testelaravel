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

class Author extends Model
// Define uma nova classe chamada Author que estende a classe Model. 
// Isso significa que Author é um modelo Eloquent e pode usar todos os métodos e propriedades de Model.

{
    use HasFactory;
    // Inclui a trait HasFactory na classe Author. 
    // Isso permite que a classe Author use o método factory() para criar instâncias para testes.

    protected $fillable = ['name', 'date_of_birth'];
    // Define a propriedade $fillable na classe Author. 
    // Esta propriedade é usada pelo Eloquent para saber quais campos podem ser preenchidos em massa.
}