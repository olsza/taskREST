<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/pets/create', [HomeController::class, 'create'])->name('pets.create');
Route::post('/pets', [HomeController::class, 'store'])->name('pets.store');
Route::get('/pets/{id}', [HomeController::class, 'show'])->name('pets.show');
Route::patch('/pets/{id}', [HomeController::class, 'update'])->name('pets.update');
Route::delete('/pets/{id}', [HomeController::class, 'destroy'])->name('pets.destroy');
