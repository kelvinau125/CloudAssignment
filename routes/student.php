<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Student\LoginController;
use App\Http\Controllers\Student\ModuleController;
use App\Http\Controllers\Student\ReviewController;
use App\Http\Controllers\Student\ResultController;

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'student'], function () {
    // student routes here
    Route::get('login', [LoginController::class, 'login'])->name('student.login');
    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('student.loginCheck');
    Route::get('index', [ModuleController::class, 'index'])->name('module.index');
    Route::get('modules/{module}/join', [ModuleController::class, 'join'])->name('modules.join');
    Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])->name('student.logout');
    Route::get('review/index', [ReviewController::class, 'index'])->name('review.index');
    Route::get('/quiz/delete', [ModuleController::class, 'delete'])->name('quiz.delete');
    Route::post('/quiz/save', [ModuleController::class, 'store'])->name('quiz.save');
    Route::get('/review/create/{submission}', [ReviewController::class, 'create'])->name('review.create');
    Route::get('/review/edit/{submission}', [ReviewController::class, 'edit'])->name('review.edit');
    Route::get('/review/delete/{submission}', [ReviewController::class, 'update'])->name('review.delete');
    Route::post('store', [ReviewController::class, 'store'])->name('review.store');
    Route::get('viewResult/index', [ResultController::class, 'index'])->name('viewResult.index');
    // login success and go to dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('.dashboard');
});
