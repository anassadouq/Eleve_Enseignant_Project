<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;


Route::resource('/', ClientController::class);
Route::resource('/client', ClientController::class);
/*
    Route::get('/client', [ClientController::class, 'index']->name('client.index'));
    Route::get('/client/create', [ClientController::class, 'create']->name('client.create'));
    Route::get('/client/{id}', [ClientController::class, 'show']->name('client.show'));
    Route::get('/client/{id}/edit', [ClientController::class, 'edit']->name('client.edit'));
    Route::post('/client', [ClientController::class, 'store']->name('client.store'));
    Route::patch('/client/{id}', [ClientController::class, 'update']->name('client.update'));
    Route::delete('/client/{id}', [ClientController::class, 'destroy']->name('client.destroy'));
*/