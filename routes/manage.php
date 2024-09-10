<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'manage'], function () {
    // admin routes here

    // Route::get('dashboard', 'AdminController@dashboard');
    Route::get('/', function () {
        return view('test');
    })->name('test');
});

?>
