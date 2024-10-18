<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// Connexion | Déconnexion
Route::post('auth/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('auth/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout')->middleware('auth:web');


// GET  => http://localhost:8000/sanctum/csrf-cookie
// POST => http://localhost:8000/auth/login?email=admin@admin.fr&password=Admin2024!
// POST => http://localhost:8000/auth/logout
