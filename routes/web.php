<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ProfesseurController;

Auth::routes();

// Redirect the home route to the login page
Route::get('/', function () {
    return redirect()->route('login');
});

// Student routes
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student', [StudentController::class, 'index'])->name('student.index');
    Route::get('/student/{absence}/edit', [StudentController::class, 'edit'])->name('student.edit');
    Route::put('/student/{absence}', [StudentController::class, 'update'])->name('student.update');
});

// Professeur routes
Route::middleware(['auth', 'role:professeur'])->group(function () {
    Route::get('/professeur', [ProfesseurController::class, 'index'])->name('professeur.index');
    Route::get('/professeur/create', [ProfesseurController::class, 'create'])->name('professeur.create');
    Route::post('/professeur', [ProfesseurController::class, 'store'])->name('professeur.store');
    Route::get('/professeur/{absence}/edit', [ProfesseurController::class, 'edit'])->name('professeur.edit');
    Route::put('/professeur/{absence}', [ProfesseurController::class, 'update'])->name('professeur.update');
    Route::delete('/professeur/{absence}', [ProfesseurController::class, 'destroy'])->name('professeur.destroy');
});

// Admin route
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('/admin', AdminController::class);
    Route::resource('/classe', ClasseController::class);
});