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

    //Register Student Route
    Route::get('registerStudent', [ParentController::class, 'studentView'])->name(name: 'registerStudent');
    Route::post('registerStudent', [ParentController::class, 'registerStudent']);

    //Get Student Data
    Route::get('student/list', [ParentController::class, 'list'])->name('student.list');
    //Student CRUD
    Route::get('student/edit/{id}', [ParentController::class, 'edit'])->name('student.edit');
    Route::put('student/update/{id}', [ParentController::class, 'update'])->name('student.update');
    Route::delete('student/delete/{id}', [ParentController::class, 'destroy'])->name(name: 'student.delete');

    //View Results  
    Route::get('student/result', [ParentController::class, 'viewStudentResults'])->name('studentResult.list');

    // Route::get('student/{id}/results', [ParentController::class, 'viewStudentResults'])->name('studentResultTest.list');

    //View Modules  
    Route::get('modules', [ParentController::class, 'viewModules'])->name('modules.list');

    //View Modules && Student
    Route::get('module/{module_id}/results',[ParentController::class,'viewModuleResults'])->name('studentModule.list');

    Route::get('/parent/reporting', [ParentController::class, 'generateReport'])->name('student.reporting');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('parent.dashboard');
});
