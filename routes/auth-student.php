<?php

use App\Http\Controllers\Student\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\User\UserViewController;
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
        Route::get('/exam/{id}', [UserViewController::class, 'index'])->name('exam.index');
        Route::get('/exam/complete', [UserViewController::class, 'show'])->name('exam.show');
        Route::post('/exam/save-answer', [UserViewController::class, 'saveAnswer'])->name('exam.save-answer');
        Route::post('/exam/get-answer', [UserViewController::class, 'getAnswer'])->name('exam.get-answer');
    });
    Route::post('logout', [LoginController::class, 'destroy'])
        ->name('logout-student');
});
