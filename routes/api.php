<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route::get('/users', [UserController::class, 'index']);
// Route::post('/users', [UserController::class, 'store']);
// Route::put('/users/{id}', [UserController::class, 'update']);
// Route::delete('/users/{id}', [UserController::class, 'destroy']);

Route::get('/users/filter', [UserController::class, 'filterAndSortUsers']);
Route::apiResource('users', UserController::class);

Route::get('/countries', [UserController::class, 'getCountries']);
