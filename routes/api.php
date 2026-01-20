<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    // Auth Routes
    Route::post('/logout', [AuthController::class, 'logout']);

    // Customer Routes
    Route::get('/customers', [CustomerController::class, 'index']);
    Route::post('/customers', [CustomerController::class, 'store']);
    Route::get('/customers/{id}', [CustomerController::class, 'show']);
    Route::put('/customers/{id}', [CustomerController::class, 'update']);
    Route::delete('/customers/{id}', [CustomerController::class, 'destroy']);

    // User
    Route::get('/users', [UsersController::class, 'index']);
    Route::post('/users', [UsersController::class, 'store']);
    Route::get('/users/{id}', [UsersController::class, 'show']);
    Route::put('/users/{id}', [UsersController::class, 'update']);
    Route::delete('/users/{id}', [UsersController::class, 'destroy']);

    // Student Routes
    Route::get('/students', [StudentController::class, 'index']);
    Route::post('/students', [StudentController::class, 'store']);
    Route::get('/students/{id}', [StudentController::class, 'show']);
    Route::put('/students/{id}', [StudentController::class, 'update']);
    Route::delete('/students/{id}', [StudentController::class, 'destroy']);
    Route::get('/students/user/{userId}', [StudentController::class, 'getByUserId']);

    // Admin Routes
    Route::prefix('admin')->group(function () {
        Route::get('/students', [AdminController::class, 'getAllStudents']);
        Route::get('/students/{id}', [AdminController::class, 'getStudentDetails']);
        Route::put('/students/{id}/status', [AdminController::class, 'updateStudentStatus']);
        Route::post('/templates', [AdminController::class, 'uploadTemplate']);
        Route::get('/dashboard/stats', [AdminController::class, 'getDashboardStats']);
        Route::get('/students/export', [AdminController::class, 'exportStudents']);

        // PDF Generation Routes
        Route::post('/students/{id}/generate-pdf', [AdminController::class, 'generatePdf']);
        Route::get('/students/{id}/download-pdf', [AdminController::class, 'downloadPdf']);
    });

});