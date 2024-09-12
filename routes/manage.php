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

    Route::get('user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('user/list', [UserController::class, 'list'])->name('user.list');
    Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('user/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('user/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');
    
    Route::get('content/create', [ContentController::class, 'create'])->name('content.create');
    Route::post('content/store', [ContentController::class, 'store'])->name('content.store');
    Route::get('content/list', [ContentController::class, 'list'])->name('content.list');
    Route::get('content/edit/{id}', [ContentController::class, 'edit'])->name('content.edit');
    Route::put('content/update/{id}', [ContentController::class, 'update'])->name('content.update');
    Route::delete('content/delete/{id}', [ContentController::class, 'destroy'])->name('content.delete');


    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('manage.dashboard');
});
