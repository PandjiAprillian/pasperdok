<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\NurseController;
use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
Route::get('/register', [PatientController::class, 'create'])->name('register');
Route::post('/register', [PatientController::class, 'store'])->name('patients.store');
Route::get('/patients/{patient}', [PatientController::class, 'show'])->name('patients.show');
Route::get('/patients/{patient}/edit', [PatientController::class, 'edit'])->name('patients.edit');
Route::patch('/patients/{patient}', [PatientController::class, 'update'])->name('patients.update');
Route::patch('/patients/{patient}/perawatan', [PatientController::class, 'perawatan'])->name('patients.perawatan');

Route::resource('/doctors', DoctorController::class);
Route::get('/doctors/{doctor}/rekap-jadwal', [DoctorController::class, 'rekapJadwal'])->name('rekap.jadwal.dokter');

Route::resource('/nurses', NurseController::class);
Route::get('/nurses/{nurse}/rekap-jadwal', [NurseController::class, 'rekapJadwal'])->name('rekap.jadwal.perawat');

Route::resource('/attendances', AttendanceController::class);
Route::post('/out-attendance', [AttendanceController::class, 'outAttendance'])->name('attendances.out');

Route::get('/admins/data-pasien', [AdminController::class, 'dataPasien'])->name('admins.data.patient');
Route::get('/admins/data-pasien/{patient}', [AdminController::class, 'showDataPasien'])->name('admins.show.patient');
Route::get('/admins/data-pasien/{patient}/edit', [AdminController::class, 'editDataPasien'])->name('admins.edit.patient');
Route::delete('/admins/{patient}', [AdminController::class, 'destroyDataPasien'])->name('admins.destroy.patient');
Route::get('/admins/data-perawat', [AdminController::class, 'dataPerawat'])->name('admins.data.nurse');
Route::get('/admins/data-dokter', [AdminController::class, 'dataDokter'])->name('admins.data.doctor');
Route::resource('/admins', AdminController::class);

Route::resource('/diseases', DiseaseController::class);
