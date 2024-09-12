<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Educator\ModuleController;
use App\Http\Controllers\Educator\FeedbackController;
use App\Http\Controllers\Educator\SubmissionController;
use App\Http\Controllers\Educator\AddQuestionController;

Route::get('/', function () {
    return view('dashboard');
})->name('/');

// Route::get('/welcome', function () {
//     return view('welcome');
// })->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/progress', function () {
//     return view('educator.progress');
// })->middleware(['auth', 'verified'])->name('progress');

// Route::post('/add-quiz', [ModuleController::class, 'store'])->name('add.quiz');
// Route::get('/questions', [ModuleController::class, 'index'])->name('question.list');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Educator
    Route::post('/addquestion/store', [AddQuestionController::class, 'store'])->name('addquestion.store');
    Route::get('/module', [ModuleController::class, 'index'])->name('educator.module.index');
    Route::delete('/module/{id}', [ModuleController::class, 'destroy'])->name('module.destroy');
    Route::get('/modules/{id}/edit', [AddQuestionController::class, 'edit'])->name('modules.edit');
    Route::put('/modules/{id}', [AddQuestionController::class, 'update'])->name('modules.update');
    Route::get('/educator/progress', [SubmissionController::class, 'index'])->name('progress.index');


    Route::get('/feedback/{submission}', [FeedbackController::class, 'index'])->name('feedback.index'); 
    Route::post('/feedback/submit/{id}', [FeedbackController::class, 'submit'])->name('feedback.submit');
    Route::put('/feedback/update/{id}', [FeedbackController::class, 'update'])->name('feedback.update');
    Route::delete('/feedback/delete/{id}', [FeedbackController::class, 'delete'])->name('feedback.delete');    

    // Route::get('/module', function () { return view('educator/module'); })->name('module');
    Route::get('/addQuestion', function () { return view('educator/addQuestion'); })->name('addQuestion');
});

require __DIR__.'/auth.php';
require __DIR__.'/manage.php';
require __DIR__.'/student.php';
require __DIR__.'/parent.php';
