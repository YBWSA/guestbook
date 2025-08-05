<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\tamuController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\PegawaiController;
use App\Http\Controllers\Api\MahasiswaController;
use App\Http\Controllers\TamuInternalController;


// API Pegawai Lingkungan YWBSA
Route::get('/ybwsa/pegawai', [PegawaiController::class, 'daftarPegawai']);
// API Mahasiswa UNISSULA
Route::get(
    '/unissula/mhs',
    [MahasiswaController::class, 'daftarMhs']
);


// routes post tamu internal
Route::post('/tamu-internal', [TamuInternalController::class, 'store'])->name('tamu-internal.store');


// Route::get('/', function () {
//     return view('tamu.view');
// });

// view bukutamu awal
Route::get('/', [tamuController::class, 'view']);

// tangkap tujuan tamu
Route::get('/tamu/get-tujuan', [tamuController::class, 'getTujuan'])->name('tamu.getTujuan');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/cek1', function () {
    return '<h1>Welcome to buku tamu admin</h1>';
})->middleware(['auth', 'verified']);


Route::get('/cek2', [tamuController::class, 'index_latihan'])->middleware(['auth', 'verified']);

Route::get('/admin', [tamuController::class, 'index'])->middleware(['auth', 'verified'])->name('admin');

require __DIR__ . '/auth.php';
