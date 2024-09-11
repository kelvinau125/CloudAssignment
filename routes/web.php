<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Educator\ModuleController;

Route::get('/', function () {
    return view('dashboard');
})->name('/');

// Route::get('/welcome', function () {
//     return view('welcome');
// })->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// Route::post('/add-quiz', [ModuleController::class, 'store'])->name('add.quiz');
// Route::get('/questions', [ModuleController::class, 'index'])->name('question.list');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Educator
    Route::post('/module/store', [ModuleController::class, 'store'])->name('module.store');
    Route::get('/module', function () { return view('educator/module'); })->name('module');
    Route::get('/addQuestion', function () { return view('educator/addQuestion'); })->name('addQuestion');
});

require __DIR__.'/auth.php';
require __DIR__.'/manage.php';
