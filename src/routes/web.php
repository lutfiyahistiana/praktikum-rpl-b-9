<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Redirect root url ke halaman login
Route::redirect('/', '/login');

// Menampilkan form login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

// Menerima data form (POST) saat tombol di-klik
Route::post('/login', [AuthController::class, 'prosesLogin']);

// Halaman dummy jika login berhasil
Route::get('/dashboard', function () {
    return '<h1>Berhasil Login! Selamat datang di Dashboard Colab.</h1>';
})->middleware('auth');