<?php

use App\Http\Controllers\Admin\DepartementClassController;
use App\Http\Controllers\Admin\EvaluationController;
use App\Http\Controllers\Admin\ExamScheduleController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Main\DepartementController;
use App\Http\Controllers\Main\ExamBankController;
use App\Http\Controllers\Main\QuestionBankController;
use App\Http\Controllers\Main\SubjectController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserViewController;
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
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard-manajemen', [DashboardController::class, 'indexAdmin'])->name('dashboard.admin');

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
});

//admin
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    //subject
    Route::get('/subject/datatable', [SubjectController::class, 'datatable'])->name('subject.datatable');
    Route::get('/subject/destroy-all', [SubjectController::class, 'destroyAll'])->name('subject.destroyAll');
    Route::resource('subject', SubjectController::class);

    //department
    Route::get('/department/datatable', [DepartementController::class, 'datatable'])->name('department.datatable');
    Route::get('/department/destroy-all', [DepartementController::class, 'destroyAll'])->name('department.destroyAll');
    Route::resource('department', DepartementController::class);

    //exam schedule
    Route::get('/exam-schedule/datatable-student', [ExamScheduleController::class, 'datatableStudent'])->name('exam-schedule.datatable-student');
    Route::post('/exam-schedule/share-store', [ExamScheduleController::class, 'shareStore'])->name('exam-schedule.shareStore');
    Route::get('/exam-schedule/datatable', [ExamScheduleController::class, 'datatable'])->name('exam-schedule.datatable');
    Route::get('/exam-schedule/destroy-all', [ExamScheduleController::class, 'destroyAll'])->name('exam-schedule.destroyAll');
    Route::get('/exam-schedule/share/{id}', [ExamScheduleController::class, 'share'])->name('exam-schedule.share');
    Route::resource('exam-schedule', ExamScheduleController::class);

    //departement class
    Route::get('/departement-class/datatable', [DepartementClassController::class, 'datatable'])->name('departement-class.datatable');
    Route::get('/departement-class/destroy-all', [DepartementClassController::class, 'destroyAll'])->name('departement-class.destroyAll');
    Route::resource('departement-class', DepartementClassController::class);

    //student
    Route::get('/student/datatable', [StudentController::class, 'datatable'])->name('student.datatable');
    Route::get('/student/destroy-all', [StudentController::class, 'destroyAll'])->name('student.destroyAll');
    Route::resource('student', StudentController::class);

    //evaluation
    Route::get('/evaluation/datatable', [EvaluationController::class, 'datatable'])->name('evaluation.datatable');
    Route::get('/evaluation/destroy-all', [EvaluationController::class, 'destroyAll'])->name('evaluation.destroyAll');
    Route::resource('evaluation', EvaluationController::class);
});

//guru
Route::prefix('admin')->middleware(['auth', 'role:teacher'])->group(function () {});

require __DIR__ . '/auth.php';
require __DIR__ . '/auth-student.php';
