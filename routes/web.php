<?php

use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();
Route::get('/register', [PatientController::class, 'create'])->name('register');
Route::post('/register', [PatientController::class, 'store'])->name('patients.store');
Route::get('/patients/{patient}', [PatientController::class, 'show'])->name('patients.show');
Route::get('/patients/{patient}/edit', [PatientController::class, 'edit'])->name('patients.edit');
Route::patch('/patients/{patient}', [PatientController::class, 'update'])->name('patients.update');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::view('/post', 'patient.post');

// Route::view('/home', 'patient.home');
