<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\DivisionController;
// Public
Route::post('/login', [AuthController::class, 'login']);

// Protected
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/switch-role', [AuthController::class, 'switchRole']);

    // Users
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

    // Roles
    Route::get('/roles', [UserController::class, 'getRoles']);
    Route::post('/users/{id}/roles', [UserController::class, 'addRole']);
    Route::delete('/users/{id}/roles/{id_role}', [UserController::class, 'removeRole']);

     // Teams
    Route::get('/teams', [TeamController::class, 'index']);
    Route::post('/teams', [TeamController::class, 'store']);
    Route::get('/teams/{id}', [TeamController::class, 'show']);
    Route::put('/teams/{id}', [TeamController::class, 'update']);
    Route::delete('/teams/{id}', [TeamController::class, 'destroy']);
    Route::get('/teams/{id}/members', [TeamController::class, 'getMembers']);
    Route::post('/teams/{id}/members', [TeamController::class, 'addMember']);
    Route::delete('/teams/{id}/members/{id_user}', [TeamController::class, 'removeMember']);

    // Divisions
    Route::get('/divisions', [DivisionController::class, 'index']);
    Route::post('/divisions', [DivisionController::class, 'store']);
    Route::get('/divisions/{id}', [DivisionController::class, 'show']);
    Route::put('/divisions/{id}', [DivisionController::class, 'update']);
    Route::delete('/divisions/{id}', [DivisionController::class, 'destroy']);
    Route::get('/divisions/{id}/members', [DivisionController::class, 'getMembers']);
    Route::post('/divisions/{id}/members', [DivisionController::class, 'addMember']);
    Route::delete('/divisions/{id}/members/{id_user}', [DivisionController::class, 'removeMember']);
});