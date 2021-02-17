<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\JurusanController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\MahasiswaController;

use App\Http\Controllers\PencarianController;

Route::get('/', [JurusanController::class, 'index']);

Route::resource('jurusans',JurusanController::class);
Route::resource('dosens',DosenController::class);
Route::resource('mahasiswas',MahasiswaController::class);
Route::resource('matakuliahs',MatakuliahController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
->name('home');

Route::get('/jurusan-dosen/{jurusan_id}', [JurusanController::class,
           'jurusanDosen'])->name('jurusan-dosen');
Route::get('/jurusan-mahasiswa/{jurusan_id}', [JurusanController::class,
           'jurusanMahasiswa'])->name('jurusan-mahasiswa');

// Route untuk tombol "Buat Matakuliah" di halaman show dosen

Route::get('/buat-matakuliah/{dosen}', [MatakuliahController::class,
           'buatMatakuliah'])->name('buat-matakuliah');


// Route untuk tombol "Ambil Matakuliah" di halaman show mahasiswa

Route::get('/mahasiswas/ambil-matakuliah/{mahasiswa}',
          [MahasiswaController::class,'ambilMatakuliah'])
          ->name('ambil-matakuliah');

Route::post('/mahasiswas/ambil-matakuliah/{mahasiswa}',
            [MahasiswaController::class,'prosesAmbilMatakuliah'])
            ->name('proses-ambil-matakuliah');



// Route untuk tombol "Daftarkan Mahasiswa" di halaman show matakuliah

Route::get('/matakuliahs/daftarkan-mahasiswa/{matakuliah}',
           [MatakuliahController::class,'daftarkanMahasiswa'])
           ->name('daftarkan-mahasiswa');

Route::post('/matakuliahs/daftarkan-mahasiswa/{matakuliah}',
           [MatakuliahController::class,'prosesDaftarkanMahasiswa'])
           ->name('proses-daftarkan-mahasiswa');

// Route Search
// Route pertama dipakai untuk menampilkan halaman form pencarian, sedangkan route kedua untuk pemrosesan form
Route::get('/pencarian',[PencarianController::class,'index']);
Route::get('/pencarian/proses',[PencarianController::class,'proses']);

 // Route untuk print
 Route::get('/printPreview/{dosen}',[DosenController::class,'reportPreview'])->name('report-preview');
