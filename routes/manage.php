<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'manage'], function () {
    // admin routes here

    Route::get('dashboard', 'AdminController@dashboard');
    Route::get('/test', function () {
        return view('test');
    });
});

?>
