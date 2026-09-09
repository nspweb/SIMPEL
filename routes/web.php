<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelatihanController;
use App\Http\Controllers\PelatihanUptdController;
use App\Http\Controllers\SertifikasiController;
use App\Http\Controllers\PenempatanController;
use App\Http\Controllers\ProduktivitasController;
use App\Http\Controllers\UmumController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExportController;

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Root redirects to Dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Dashboard Route
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Pelatihan UPTP Routes
Route::prefix('pelatihan')->name('pelatihan.')->group(function () {
    Route::get('/', [PelatihanController::class, 'index'])->name('index');
    Route::post('/', [PelatihanController::class, 'store'])->name('store');
    Route::put('/{id}', [PelatihanController::class, 'update'])->name('update');
    Route::delete('/{id}', [PelatihanController::class, 'destroy'])->name('destroy');

    // Pelatihan UPTD Sub-routes
    Route::get('/uptd', [PelatihanUptdController::class, 'index'])->name('uptd');
    Route::post('/uptd', [PelatihanUptdController::class, 'store'])->name('uptd.store');
    Route::put('/uptd/{id}', [PelatihanUptdController::class, 'update'])->name('uptd.update');
    Route::delete('/uptd/{id}', [PelatihanUptdController::class, 'destroy'])->name('uptd.destroy');
});

// Sertifikasi LSP Routes
Route::prefix('sertifikasi')->name('sertifikasi.')->group(function () {
    Route::get('/', [SertifikasiController::class, 'index'])->name('index');
    Route::post('/', [SertifikasiController::class, 'store'])->name('store');
    Route::put('/{id}', [SertifikasiController::class, 'update'])->name('update');
    Route::delete('/{id}', [SertifikasiController::class, 'destroy'])->name('destroy');
});

// Penempatan Alumni Routes
Route::prefix('penempatan')->name('penempatan.')->group(function () {
    Route::get('/', [PenempatanController::class, 'index'])->name('index');
    Route::post('/', [PenempatanController::class, 'store'])->name('store');
    Route::put('/{id}', [PenempatanController::class, 'update'])->name('update');
    Route::delete('/{id}', [PenempatanController::class, 'destroy'])->name('destroy');
});

// Produktivitas Routes
Route::prefix('produktivitas')->name('produktivitas.')->group(function () {
    Route::get('/', [ProduktivitasController::class, 'index'])->name('index');
    Route::post('/', [ProduktivitasController::class, 'store'])->name('store');
    Route::put('/{id}', [ProduktivitasController::class, 'update'])->name('update');
    Route::delete('/{id}', [ProduktivitasController::class, 'destroy'])->name('destroy');
});

// Umum & Keuangan Routes
Route::prefix('umum')->name('umum.')->group(function () {
    Route::get('/', [UmumController::class, 'index'])->name('index');
    Route::post('/pengadaan', [UmumController::class, 'storePengadaan'])->name('pengadaan.store');
    Route::delete('/pengadaan/{id}', [UmumController::class, 'destroyPengadaan'])->name('pengadaan.destroy');
    Route::post('/pembayaran', [UmumController::class, 'storePembayaran'])->name('pembayaran.store');
    Route::delete('/pembayaran/{id}', [UmumController::class, 'destroyPembayaran'])->name('pembayaran.destroy');
});

// Input Forms Hub & Sub-pages
Route::prefix('input')->name('input.')->group(function () {
    Route::get('/', [InputController::class, 'index'])->name('index');
    Route::get('/penyelenggara', [InputController::class, 'penyelenggara'])->name('penyelenggara');
    Route::get('/pemberdayaan', [InputController::class, 'pemberdayaan'])->name('pemberdayaan');
    Route::get('/lsp', [InputController::class, 'lsp'])->name('lsp');
    Route::get('/produktivitas', [InputController::class, 'produktivitas'])->name('produktivitas');
    Route::get('/umum', [InputController::class, 'umum'])->name('umum');
});

// Export CSV
Route::get('/export/{module}', [ExportController::class, 'exportCsv'])->name('export.csv');
