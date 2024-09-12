<?php

use App\Http\Controllers\Educator\AddQuestionController;
use App\Http\Controllers\Educator\ModuleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

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
    Route::post('/addquestion/store', [AddQuestionController::class, 'store'])->name('addquestion.store');
    Route::get('/module', [ModuleController::class, 'index'])->name('module.index');
    Route::delete('/module/{id}', [ModuleController::class, 'destroy'])->name('module.destroy');
    Route::get('/modules/{id}/edit', [AddQuestionController::class, 'edit'])->name('modules.edit');
    Route::put('/modules/{id}', [AddQuestionController::class, 'update'])->name('modules.update');

    // Route::get('/module', function () { return view('educator/module'); })->name('module');
    Route::get('/addQuestion', function () { return view('educator/addQuestion'); })->name('addQuestion');
});

require __DIR__.'/auth.php';
require __DIR__.'/manage.php';
require __DIR__.'/parent.php';
