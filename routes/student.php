<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Student\LoginController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'student'], function () {
    // student routes here
    Route::get('login', [LoginController::class, 'login'])->name('student.login');
    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('student.loginCheck');

    // login success and go to dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('.dashboard');
});
