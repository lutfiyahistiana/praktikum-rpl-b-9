<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

// Temporary OSS debug route - remove after testing
Route::get('/debug-oss', function () {
    try {
        $disk = \Illuminate\Support\Facades\Storage::disk('oss');
        $disk->put('test.txt', 'hello');
        $url = $disk->url('test.txt');
        $disk->delete('test.txt');
        return response()->json(['status' => 'OK', 'url' => $url]);
    } catch (\Throwable $e) {
        return response()->json(['status' => 'ERROR', 'message' => $e->getMessage()]);
    }
})->middleware('auth');

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
    Route::post('/chatbot/send',   [\App\Http\Controllers\ChatbotController::class, 'sendMessage'])->name('chatbot.send');
    Route::get('/chatbot/history', [\App\Http\Controllers\ChatbotController::class, 'getHistory'])->name('chatbot.history');
    Route::get('/materials/download/{id}', [\App\Http\Controllers\MaterialController::class, 'download'])->name('materials.download');
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
    Route::get('/add-material', [\App\Http\Controllers\Pelatih\MaterialController::class,  'createMaterial'])->name('materials.create');
    Route::post('/add-material', [\App\Http\Controllers\Pelatih\MaterialController::class, 'storeMaterial'])->name('materials.store');
    Route::get('/materials/{id}/edit', [\App\Http\Controllers\Pelatih\MaterialController::class, 'editMaterial'])->name('materials.edit');
    Route::put('/materials/{id}', [\App\Http\Controllers\Pelatih\MaterialController::class, 'updateMaterial'])->name('materials.update');
    Route::delete('/materials/{id}', [\App\Http\Controllers\Pelatih\MaterialController::class, 'destroyMaterial'])->name('materials.destroy');
});

// Ketua Tim
Route::prefix('ketua-tim')->name('ketua_tim.')->middleware(['auth', 'role:ketua_tim'])->group(function () {
    Route::get('/dashboard',     [\App\Http\Controllers\KetuaTim\DashboardController::class, 'showDashboard'])->name('dashboard');
    Route::get('/task',          [\App\Http\Controllers\KetuaTim\TaskController::class,       'showTask'])->name('task');
    Route::get('/task/tambah',   [\App\Http\Controllers\KetuaTim\TaskController::class,       'tambah'])->name('task.tambah');
    Route::post('/task/tambah',  [\App\Http\Controllers\KetuaTim\TaskController::class,       'store'])->name('task.store');
    Route::delete('/task/{id}',  [\App\Http\Controllers\KetuaTim\TaskController::class,       'destroy'])->name('task.destroy');
    Route::patch('/task/{id}/revert', [\App\Http\Controllers\KetuaTim\TaskController::class,  'revertStatus'])->name('task.revert');
    Route::get('/task/{id}',     [\App\Http\Controllers\KetuaTim\TaskController::class,       'show'])->name('task.detail');
    Route::get('/materials',     [\App\Http\Controllers\KetuaTim\MaterialController::class,   'showMaterials'])->name('materials');
});

// Admin
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin,superadmin'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class,    'showDashboard'])->name('dashboard');
    Route::get('/task',      [\App\Http\Controllers\Admin\TaskController::class,          'showTask'])->name('task');
    Route::get('/task/{id}', [\App\Http\Controllers\Admin\TaskController::class,          'show'])->name('task.detail');
    Route::get('/manage-role', [\App\Http\Controllers\Admin\ManageRoleController::class,  'showManageRole'])->name('manageRole');
    Route::post('/manage-role', [\App\Http\Controllers\Admin\ManageRoleController::class,  'store'])->name('manageRole.store');
    Route::post('/manage-role/update', [\App\Http\Controllers\Admin\ManageRoleController::class,  'updateAccount'])->name('manageRole.update');
    Route::post('/manage-role/delete', [\App\Http\Controllers\Admin\ManageRoleController::class,  'destroy'])->name('manageRole.destroy');
    Route::get('/materials', [\App\Http\Controllers\Admin\MaterialController::class,      'showMaterials'])->name('materials');
});

// Superadmin
Route::prefix('superadmin')->name('superadmin.')->middleware(['auth', 'role:superadmin'])->group(function () {
    Route::get('/dashboard',   [\App\Http\Controllers\Superadmin\DashboardController::class,   'showDashboard'])->name('dashboard');
    Route::get('/task',        [\App\Http\Controllers\Superadmin\TaskController::class,         'showTask'])->name('task');
    Route::get('/task/{id}',   [\App\Http\Controllers\Superadmin\TaskController::class,         'show'])->name('task.detail');
    Route::get('/manage-role', [\App\Http\Controllers\Superadmin\ManageRoleController::class,   'showManageRole'])->name('manageRole');
    Route::post('/manage-role', [\App\Http\Controllers\Superadmin\ManageRoleController::class,  'store'])->name('manageRole.store');
    Route::post('/manage-role/update', [\App\Http\Controllers\Superadmin\ManageRoleController::class, 'update'])->name('manageRole.update');
    Route::post('/manage-role/delete', [\App\Http\Controllers\Superadmin\ManageRoleController::class, 'destroy'])->name('manageRole.destroy');
    Route::get('/materials',   [\App\Http\Controllers\Superadmin\MaterialController::class,     'showMaterials'])->name('materials');
});

Route::middleware('auth')->group(function () {
    Route::get('/tasks',  [\App\Http\Controllers\TaskController::class, 'index']);
    Route::post('/tasks', [\App\Http\Controllers\TaskController::class, 'store']);
});
