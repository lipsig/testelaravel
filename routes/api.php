<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\AuthController;

Route::middleware('auth:api')->group(function () {
    Route::apiResource('authors', AuthorController::class);
});

Route::middleware('auth:api')->group(function () {
    Route::apiResource('books', BookController::class);
});

Route::middleware('auth:api')->group(function () {
    Route::apiResource('loans', LoanController::class)->except(['update', 'destroy']);
});


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);