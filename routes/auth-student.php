<?php

use App\Http\Controllers\Student\Auth\LoginController;
use App\Http\Controllers\Admin\DepartementClassController;
use App\Http\Controllers\Admin\ExamScheduleController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Main\DepartementController;
use App\Http\Controllers\Main\SubjectController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:student')->group(function () {
    Route::get('/', [LoginController::class, 'create'])
        ->name('login-student');
    Route::post('/', [LoginController::class, 'store']);
});

Route::middleware('auth:student')->group(function () {
    //user
    Route::middleware(['role:student'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard/create', [DashboardController::class, 'create'])->name('dashboard.create');
        Route::get('/dashboard/show', [DashboardController::class, 'show'])->name('dashboard.show');
    });
    Route::post('logout', [LoginController::class, 'destroy'])
        ->name('logout-student');
});
