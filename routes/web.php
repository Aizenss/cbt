<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Main\DepartementController;
use App\Http\Controllers\Main\ExamBankController;
use App\Http\Controllers\Main\QuestionBankController;
use App\Http\Controllers\Main\SubjectController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

//halaman awal
Route::get('/', function () {
    return view('welcome');
});

//penting login
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//admin dan guru
Route::middleware(['auth', 'role:admin|guru'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'viewAdminGuru'])->name('dashboard-admin-guru');

    //exam bank
    Route::get('/exam-bank/datatable', [ExamBankController::class, 'datatable'])->name('exam-bank.datatable');
    Route::get('/exam-bank/destroy-all', [ExamBankController::class, 'destroyAll'])->name('exam-bank.destroyAll');
    Route::resource('exam-bank', ExamBankController::class);

    //question bank
    Route::post('/question-bank/import-excel', [QuestionBankController::class, 'importExcelStore'])->name('question-bank.importExcelStore');
    Route::get('/question-bank/import-excel', [QuestionBankController::class, 'importExcel'])->name('question-bank.importExcel');
    Route::get('/question-bank/datatable', [QuestionBankController::class, 'datatable'])->name('question-bank.datatable');
    Route::get('/question-bank/destroy-all', [ExamBankController::class, 'destroyAll'])->name('question-bank.destroyAll');
    Route::resource('question-bank', QuestionBankController::class);

    //subject
    Route::get('/subject/datatable', [SubjectController::class, 'datatable'])->name('subject.datatable');
    Route::get('/subject/destroy-all', [SubjectController::class, 'destroyAll'])->name('subject.destroyAll');
    Route::resource('subject', SubjectController::class);

    //department
    Route::get('/department/datatable', [DepartementController::class, 'datatable'])->name('department.datatable');
    Route::get('/department/destroy-all', [DepartementController::class, 'destroyAll'])->name('department.destroyAll');
    Route::resource('department', DepartementController::class);
});

//admin
Route::middleware(['auth', 'role:admin'])->group(function () {});

//guru
Route::middleware(['auth', 'role:guru'])->group(function () {});

//user
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user', [DashboardController::class, 'viewUser'])->name('dashboard-user');
});

require __DIR__ . '/auth.php';
