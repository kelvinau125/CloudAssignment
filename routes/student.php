<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Student\LoginController;
use App\Http\Controllers\Student\ModuleController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'student'], function () {
    // student routes here
    Route::get('login', [LoginController::class, 'login'])->name('student.login');
    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('student.loginCheck');
    Route::get('index', [ModuleController::class, 'index'])->name('module.index');
    Route::post('modules/{module}/join', [ModuleController::class, 'join'])->name('modules.join');
    Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])->name('student.logout');

    Route::post('/quiz/save', [ModuleController::class, 'store'])->name('quiz.save');

    // login success and go to dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('.dashboard');
});
