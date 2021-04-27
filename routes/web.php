<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\NurseController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
Route::get('/register', [PatientController::class, 'create'])->name('register');
Route::post('/register', [PatientController::class, 'store'])->name('patients.store');

Route::group(['middleware' => ['auth']], function () {

    Route::get('/patients/{patient}', [PatientController::class, 'show'])->name('patients.show');
    Route::get('/patients/{patient}/edit', [PatientController::class, 'edit'])->name('patients.edit')->middleware('role:patient|admin');
    Route::patch('/patients/{patient}', [PatientController::class, 'update'])->name('patients.update')->middleware('role:patient|admin');
    Route::patch('/patients/{patient}/perawatan', [PatientController::class, 'perawatan'])->name('patients.perawatan')->middleware('role:doctor|admin');

    Route::group(['middleware' => ['role:doctor|admin']], function () {
        Route::resource('/doctors', DoctorController::class);
        Route::get('/doctors/{doctor}/rekap-jadwal', [DoctorController::class, 'rekapJadwal'])->name('rekap.jadwal.dokter');
    });

    Route::group(['middlware' => ['role:nurse|admin']], function () {
        Route::resource('/nurses', NurseController::class);
        Route::get('/nurses/{nurse}/rekap-jadwal', [NurseController::class, 'rekapJadwal'])->name('rekap.jadwal.perawat');
    });

    Route::group(['middleware' => ['role:nurse|doctor|admin']], function () {
        Route::resource('/attendances', AttendanceController::class);
        Route::post('/out-attendance', [AttendanceController::class, 'outAttendance'])->name('attendances.out');
    });

    Route::group(['middleware' => ['role:admin']], function () {

        Route::get('/admins/data-pasien', [AdminController::class, 'dataPasien'])->name('admins.data.patient');
        Route::get('/admins/data-pasien/{patient}', [AdminController::class, 'showDataPasien'])->name('admins.show.patient');
        Route::get('/admins/data-pasien/{patient}/edit', [AdminController::class, 'editDataPasien'])->name('admins.edit.patient');
        Route::delete('/admins/{patient}/hapus-pasien', [AdminController::class, 'destroyDataPasien'])->name('admins.destroy.patient');
        Route::get('/admins/data-perawat', [AdminController::class, 'dataPerawat'])->name('admins.data.nurse');
        Route::get('/admins/data-dokter', [AdminController::class, 'dataDokter'])->name('admins.data.doctor');
        Route::get('/admins/data-admin', [AdminController::class, 'dataAdmin'])->name('admins.data.admins');
        Route::get('/admins/search', [SearchController::class, 'adminSearch'])->name('admins.search');
        Route::resource('/admins', AdminController::class);

        Route::resource('/diseases', DiseaseController::class);

        Route::resource('/rooms', RoomController::class);
    });
});
