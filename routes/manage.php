<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Manage\LoginController;
use App\Http\Controllers\Manage\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'manage'], function () {
    // admin routes here

    // Route::get('dashboard', 'AdminController@dashboard');
    Route::get('login', [LoginController::class, 'login'])->name('admin.login');
    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('manage.loginCheck');
    // Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('admin.loginCheck');
    // Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('admin.logout');


    Route::get('/', function () {
        return view('test');
    })->name('test');

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});
