<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;

Route::middleware('auth:api')->group(function () {
    Route::apiResource('authors', AuthorController::class);
});

Route::middleware('auth:api')->group(function () {
    Route::apiResource('books', BookController::class);
});

Route::middleware('auth:api')->group(function () {
    Route::apiResource('loans', LoanController::class)->except(['update', 'destroy']);
});