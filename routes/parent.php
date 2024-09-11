<?php

use App\Http\Controllers\Parent\AuthenticatedSessionController;
use App\Http\Controllers\Parent\LoginController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'parent'], function () {
    // parent routes here

    Route::get('login', [LoginController::class, 'login'])->name('parent.login');
    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('parent.loginCheck');


    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('parent.dashboard');
});
