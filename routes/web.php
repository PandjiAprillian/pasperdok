<?php

use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();
Route::get('/register', [PatientController::class, 'create'])->name('register');
Route::post('/register', [PatientController::class, 'store'])->name('patients.store');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::view('/post', 'patient.post');

// Route::view('/home', 'patient.home');
