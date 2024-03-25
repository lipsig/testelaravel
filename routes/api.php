<?php
// Inicia um bloco de código PHP

use Illuminate\Support\Facades\Route;
// Importa a classe Route do namespace Illuminate\Support\Facades. 
// Esta classe é usada para definir as rotas da aplicação.

use App\Http\Controllers\AuthController;
// Importa a classe AuthController do namespace App\Http\Controllers. 
// Esta classe é usada para lidar com a autenticação.

use App\Http\Controllers\AuthorController;
// Importa a classe AuthorController do namespace App\Http\Controllers. 
// Esta classe é usada para lidar com as operações relacionadas aos autores.

use App\Http\Controllers\BookController;
// Importa a classe BookController do namespace App\Http\Controllers. 
// Esta classe é usada para lidar com as operações relacionadas aos livros.

use App\Http\Controllers\LoanController;
// Importa a classe LoanController do namespace App\Http\Controllers. 
// Esta classe é usada para lidar com as operações relacionadas aos empréstimos.

use App\Http\Controllers\StudentController;
// Importa a classe StudentController do namespace App\Http\Controllers. 
// Esta classe é usada para lidar com as operações relacionadas aos estudantes.

Route::middleware('auth:api')->group(function () {
    // Define um grupo de rotas que requerem autenticação. 
    // O middleware 'auth:api' é usado para garantir que apenas usuários autenticados possam acessar essas rotas.

    Route::apiResource('authors', AuthorController::class);
    // Define as rotas para o recurso 'authors' usando o AuthorController. 
    // Isso cria várias rotas para lidar com operações CRUD em autores.

    Route::apiResource('books', BookController::class);
    // Define as rotas para o recurso 'books' usando o BookController. 
    // Isso cria várias rotas para lidar com operações CRUD em livros.

    Route::apiResource('loans', LoanController::class)->except(['update', 'destroy']);
    // Define as rotas para o recurso 'loans' usando o LoanController, exceto as rotas para atualizar e deletar empréstimos.

    Route::apiResource('students', StudentController::class); 
    // Define as rotas para o recurso 'students' usando o StudentController. 
    // Isso cria várias rotas para lidar com operações CRUD em estudantes.
});

Route::post('/register', [AuthController::class, 'register']);
// Define uma rota POST para '/register' que usa o método 'register' do AuthController. 
// Esta rota é usada para registrar novos usuários.

Route::post('/login', [AuthController::class, 'login']);
// Define uma rota POST para '/login' que usa o método 'login' do AuthController. 
// Esta rota é usada para autenticar usuários.