<?php

use App\Http\Controllers\Parent\AuthenticatedSessionController;
use App\Http\Controllers\Parent\LoginController;
use App\Http\Controllers\Parent\ParentController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'parent'], function () {
    // parent routes here

    Route::get('login', [LoginController::class, 'login'])->name('parent.login');
    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('parent.loginCheck');

    //Parent Register Route
    Route::get('register', [ParentController::class, 'create'])->name(name: 'register');
    Route::post('register', [ParentController::class, 'store']);

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('parent.dashboard');
});
