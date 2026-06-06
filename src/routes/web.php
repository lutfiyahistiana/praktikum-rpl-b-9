<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\TaskController;

// Redirect root url ke halaman login
Route::redirect('/', '/login');

// Menampilkan form login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

// Menerima data form (POST) saat tombol di-klik
Route::post('/login', [AuthController::class, 'prosesLogin']);

// // Halaman dummy jika login berhasil
// Route::get('/dashboard', function () {
//     return '<h1>Berhasil Login! Selamat datang di Dashboard Colab.</h1>';
// })->middleware('auth');

Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard');
Route::get('/materials', [MaterialController::class, 'showMaterials'])->name('materials');

Route::get('/task', [TaskController::class, 'showTask'])->name('task');
Route::get('/task/detail', function () {
    return view('task.detail', [
        'title' => 'Task Detail'
    ]);
});