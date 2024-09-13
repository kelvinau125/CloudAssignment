<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Student\LoginController;
use App\Http\Controllers\Student\ModuleController;
use App\Http\Controllers\Student\ReviewController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'student'], function () {
    // student routes here
    Route::get('login', [LoginController::class, 'login'])->name('student.login');
    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('student.loginCheck');
    Route::get('index', [ModuleController::class, 'index'])->name('module.index');
    Route::post('modules/{module}/join', [ModuleController::class, 'join'])->name('modules.join');
    Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])->name('student.logout');
    Route::get('review/index', [ReviewController::class, 'index'])->name('review.index');
    Route::post('/quiz/save', [ModuleController::class, 'store'])->name('quiz.save');
    Route::get('/review/create/{submission}', [ReviewController::class, 'create'])->name('review.create');
    Route::get('/review/edit/{submission}', [ReviewController::class, 'edit'])->name('review.edit');
    Route::post('store', [ReviewController::class, 'store'])->name('review.store');
    // login success and go to dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('.dashboard');
});
