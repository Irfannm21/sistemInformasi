<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\JurusanController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\MahasiswaController;

Route::get('/', [JurusanController::class, 'index']);

Route::resource('jurusans',JurusanController::class);
Route::resource('dosens',DosenController::class);
Route::resource('mahasiswas',MahasiswaController::class);
Route::resource('matakuliahs',MatakuliahController::class);

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
// ->name('home');

Route::get('/jurusan-dosen/{jurusan_id}', [JurusanController::class,
           'jurusanDosen'])->name('jurusan-dosen');
Route::get('/jurusan-mahasiswa/{jurusan_id}', [JurusanController::class,
           'jurusanMahasiswa'])->name('jurusan-mahasiswa');