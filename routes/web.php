<?php

use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\AbsensiController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
    Route::resource('karyawan', KaryawanController::class);
Route::resource('gaji', GajiController::class);
Route::resource('absensi', AbsensiController::class);
});
