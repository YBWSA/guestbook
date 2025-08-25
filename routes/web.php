<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\tamuController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\PegawaiController;
use App\Http\Controllers\Api\MahasiswaController;
use App\Http\Controllers\TamuInternalController;
use App\Http\Controllers\TamuEksternalController;
use App\Http\Controllers\TamuMhsController;




// API Pegawai Lingkungan YWBSA
Route::get('/ybwsa/pegawai', [PegawaiController::class, 'daftarPegawai']);
// API Mahasiswa UNISSULA
Route::get(
    '/unissula/mhs',
    [MahasiswaController::class, 'daftarMhs']
);


// view bukutamu awal
Route::get('/', [tamuController::class, 'view']);

// tangkap tujuan tamu
Route::get('/tamu/get-tujuan', [tamuController::class, 'getTujuan'])->name('tamu.getTujuan');

// get total tamu hari ini
Route::get('/tamu/count-today', [TamuController::class, 'getTotalTamuHariIni']);


// routes post tamu internal start
Route::post('/tamu-internal', [TamuInternalController::class, 'store'])->name('tamu-internal.store');
Route::post('/tamu-eksternal', [TamuEksternalController::class, 'store'])->name('tamu-eksternal.store');
Route::post('/tamu-mhs', [TamuMhsController::class, 'store'])->name('tamu-mhs.store');
// routes post tamu internal end










// halaman admin
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Route::get('/cek1', function () {
//     return '<h1>Welcome to buku tamu admin</h1>';
// })->middleware(['auth', 'verified']);


// Route::get('/cek2', [tamuController::class, 'index_latihan'])->middleware(['auth', 'verified']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin', [tamuController::class, 'index'])->name('admin');
    Route::get('/statistik', [tamuController::class, 'statistik'])->name('admin.statistik');
    Route::get('/export-excel', [tamuController::class, 'exportExcel'])->name('admin.exportExcel');
    Route::get('/internal', [tamuController::class, 'tamuInternal'])->name('internal');
    Route::get('/eksternal', [tamuController::class, 'tamuEksternal'])->name('eksternal');
    Route::get('/mhs', [tamuController::class, 'tamuMhs'])->name('mahasiswa');
});

require __DIR__ . '/auth.php';
