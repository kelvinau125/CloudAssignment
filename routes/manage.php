<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Manage\LoginController;
use App\Http\Controllers\Manage\UserController;
use App\Http\Controllers\Manage\ContentController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'manage'], function () {
    // admin routes here

    // Route::get('dashboard', 'AdminController@dashboard');
    Route::get('login', [LoginController::class, 'login'])->name('admin.login');
    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('manage.loginCheck');
    // Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('admin.loginCheck');
    // Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('admin.logout');

    Route::get('user/list', [UserController::class, 'list'])->name('user.list');
    Route::get('content/list', [ContentController::class, 'list'])->name('content.list');


    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('manage.dashboard');
});
