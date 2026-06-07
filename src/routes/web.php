<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

// Redirect root ke login
Route::redirect('/', '/login');

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'prosesLogin']);
Route::post('/logout', [AuthController::class, 'webLogout'])->name('logout')->middleware('auth');
Route::post('/switch-role', [AuthController::class, 'switchRoleWeb'])->name('switch.role')->middleware('auth');

// Anggota Tim
Route::prefix('anggota-tim')->name('anggota_tim.')->middleware(['auth', 'role:anggota_tim'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Anggota\DashboardController::class, 'showDashboard'])->name('dashboard');
    Route::get('/task',      [\App\Http\Controllers\Anggota\TaskController::class, 'showTask'])->name('task');
    Route::get('/task/{id}', [\App\Http\Controllers\Anggota\TaskController::class, 'show'])->name('task.detail');
    Route::get('/materials', [\App\Http\Controllers\Anggota\MaterialController::class, 'showMaterials'])->name('materials');
});

// Pelatih
// Route::prefix('pelatih')->name('pelatih.')->middleware(['auth', 'role:pelatih'])->group(function () {
//     Route::get('/dashboard', [\App\Http\Controllers\Pelatih\DashboardController::class, 'index'])->name('dashboard');
//     Route::get('/task',      [\App\Http\Controllers\Pelatih\TaskController::class, 'index'])->name('task');
//     Route::get('/materials', [\App\Http\Controllers\Pelatih\MaterialController::class, 'index'])->name('materials');
// });

// Ketua Tim
// Route::prefix('ketua-tim')->name('ketua_tim.')->middleware(['auth', 'role:ketua_tim'])->group(function () {
//     Route::get('/dashboard', [\App\Http\Controllers\Ketua\DashboardController::class, 'index'])->name('dashboard');
//     Route::get('/task',      [\App\Http\Controllers\Ketua\TaskController::class, 'index'])->name('task');
//     Route::get('/materials', [\App\Http\Controllers\Ketua\MaterialController::class, 'index'])->name('materials');
// });

// Admin
// Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin,superadmin'])->group(function () {
//     Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
//     Route::get('/users',     [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users');
// });

// Superadmin
// Route::prefix('superadmin')->name('superadmin.')->middleware(['auth', 'role:superadmin'])->group(function () {
//     Route::get('/dashboard', [\App\Http\Controllers\SuperAdmin\DashboardController::class, 'index'])->name('dashboard');
//     Route::get('/users',     [\App\Http\Controllers\SuperAdmin\UserController::class, 'index'])->name('users');
// });

// Profil
Route::middleware('auth')->group(function () {
    Route::get('/profil', [\App\Http\Controllers\ProfilController::class, 'index'])->name('profil');
});