<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PemeriksaanController;
use App\Http\Controllers\DiagnosaController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\ResepController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:pendaftaran'])->group(function () {
    Route::get('/pasien/create', [PasienController::class, 'create'])->name('pasien.create');
    Route::post('/pasien', [PasienController::class, 'store'])->name('pasien.store');
    Route::get('/pasien', [PasienController::class, 'index'])->name('pasien.index');
});

Route::middleware(['auth', 'role:perawat'])->group(function () {
    Route::get('/pemeriksaan/create', [PemeriksaanController::class, 'create'])->name('pemeriksaan.create');
    Route::post('/pemeriksaan', [PemeriksaanController::class, 'store'])->name('pemeriksaan.store');
    Route::get('/pemeriksaan', [PemeriksaanController::class, 'index'])->name('pemeriksaan.index');
});

Route::middleware(['auth', 'role:dokter'])->group(function () {
    Route::get('/diagnosa', [DiagnosaController::class, 'index'])->name('diagnosa.index');
    Route::get('/diagnosa/{id}', [DiagnosaController::class, 'create'])->name('diagnosa.create');
    Route::post('/diagnosa/{id}', [DiagnosaController::class, 'store'])->name('diagnosa.store');
});

Route::middleware(['auth', 'role:apoteker'])->group(function () {
    // Daftar pemeriksaan yang butuh resep
    Route::get('/inputobat', [ResepController::class, 'index'])->name('inputobat.index');
    
    // Management Obat
    Route::get('/obat', [ObatController::class, 'index'])->name('obat.index');
    Route::get('/obat/create', [ObatController::class, 'create'])->name('obat.create');
    Route::post('/obat', [ObatController::class, 'store'])->name('obat.store');
    
    // Management Resep - LENGKAP dengan semua CRUD
    Route::get('/reseps', [ResepController::class, 'indexReseps'])->name('reseps.index'); // Daftar semua resep
    Route::get('/reseps/create', [ResepController::class, 'create'])->name('reseps.create'); // Form input resep
    Route::post('/reseps', [ResepController::class, 'store'])->name('reseps.store'); // Simpan resep
    Route::get('/reseps/{resep}', [ResepController::class, 'show'])->name('reseps.show'); // Detail resep
    Route::get('/reseps/{resep}/edit', [ResepController::class, 'edit'])->name('reseps.edit'); // Form edit resep
    Route::put('/reseps/{resep}', [ResepController::class, 'update'])->name('reseps.update'); // Update resep
    Route::delete('/reseps/{resep}', [ResepController::class, 'destroy'])->name('reseps.destroy'); // Hapus resep
});

Route::middleware(['auth', 'role:apoteker,dokter,perawat'])->group(function () {
    Route::get('/pasien/{id}', [PasienController::class, 'show'])->name('pasien.show');
});

require __DIR__.'/auth.php';
