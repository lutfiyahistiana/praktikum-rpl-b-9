<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;

Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');


// Redirect root ke login
Route::redirect('/', '/login');

// Auth
Route::get('/login',       [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',      [AuthController::class, 'prosesLogin']);
Route::post('/logout',     [AuthController::class, 'webLogout'])->name('logout')->middleware('auth');
Route::post('/switch-role',[AuthController::class, 'switchRoleWeb'])->name('switch.role')->middleware('auth');

// Profil
Route::middleware('auth')->group(function () {
    Route::get('/profil', [\App\Http\Controllers\ProfilController::class, 'index'])->name('profil');
    Route::put('/profil', [\App\Http\Controllers\ProfilController::class, 'update'])->name('profil.update'); //
});




// Anggota Tim
Route::prefix('anggota-tim')->name('anggota_tim.')->middleware(['auth', 'role:anggota_tim'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Anggota\DashboardController::class,   'showDashboard'])->name('dashboard');
    Route::get('/task',      [\App\Http\Controllers\Anggota\TaskController::class,        'showTask'])->name('task');
    Route::get('/task/{id}', [\App\Http\Controllers\Anggota\TaskController::class,        'show'])->name('task.detail');
    Route::post('/task/{id}/progress', [\App\Http\Controllers\Anggota\TaskController::class, 'storeProgress'])->name('task.progress.store');
    Route::get('/materials', [\App\Http\Controllers\Anggota\MaterialController::class,    'showMaterials'])->name('materials');
});


// Pelatih
Route::prefix('pelatih')->name('pelatih.')->middleware(['auth', 'role:pelatih'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Pelatih\DashboardController::class,   'showDashboard'])->name('dashboard');
    Route::get('/materials', [\App\Http\Controllers\Pelatih\MaterialController::class,    'showMaterials'])->name('materials');
});

// Ketua Tim
Route::prefix('ketua-tim')->name('ketua_tim.')->middleware(['auth', 'role:ketua_tim'])->group(function () {
    Route::get('/dashboard',     [\App\Http\Controllers\KetuaTim\DashboardController::class, 'showDashboard'])->name('dashboard');
    Route::get('/task',          [\App\Http\Controllers\KetuaTim\TaskController::class,       'showTask'])->name('task');
    Route::get('/task/tambah',   [\App\Http\Controllers\KetuaTim\TaskController::class,       'tambah'])->name('task.tambah');
    Route::get('/task/{id}',     [\App\Http\Controllers\KetuaTim\TaskController::class,       'show'])->name('task.detail');
    Route::get('/materials',     [\App\Http\Controllers\KetuaTim\MaterialController::class,   'showMaterials'])->name('materials');
});

// Admin
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin,superadmin'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class,    'showDashboard'])->name('dashboard');
    Route::get('/task',      [\App\Http\Controllers\Admin\TaskController::class,          'showTask'])->name('task');
    Route::get('/task/{id}', [\App\Http\Controllers\Admin\TaskController::class,          'show'])->name('task.detail');
    Route::get('/manage-role', [\App\Http\Controllers\Admin\ManageRoleController::class,  'showManageRole'])->name('manageRole');
    Route::get('/materials', [\App\Http\Controllers\Admin\MaterialController::class,      'showMaterials'])->name('materials');
});

// Superadmin
Route::prefix('superadmin')->name('superadmin.')->middleware(['auth', 'role:superadmin'])->group(function () {
    Route::get('/dashboard',   [\App\Http\Controllers\Superadmin\DashboardController::class,   'showDashboard'])->name('dashboard');
    Route::get('/task',        [\App\Http\Controllers\Superadmin\TaskController::class,         'showTask'])->name('task');
    Route::get('/task/{id}',   [\App\Http\Controllers\Superadmin\TaskController::class,         'show'])->name('task.detail');
    Route::get('/manage-role', [\App\Http\Controllers\Superadmin\ManageRoleController::class,   'showManageRole'])->name('manageRole');
    Route::get('/materials',   [\App\Http\Controllers\Superadmin\MaterialController::class,     'showMaterials'])->name('materials');
});

Route::get('/tasks', [TaskController::class, 'index']);
Route::post('/tasks', [TaskController::class, 'store']);


Route::post('/task/{id}/progress', [\App\Http\Controllers\Anggota\TaskController::class, 'storeProgress'])->name('task.progress.store');