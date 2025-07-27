<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\HistorisController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PeramalanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


Auth::routes();

Route::middleware(['auth', 'user.status'])->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    
    Route::prefix('/profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('profile');
        Route::put('update', [ProfileController::class, 'update'])->name('profile.update');
    });
    Route::prefix('/pengguna')->middleware('is.admin')->group(function () {
        Route::get('/', [PenggunaController::class, 'index'])->name('pengguna');
        Route::post('/create', [PenggunaController::class, 'create'])->name('pengguna.create');
        Route::put('update/{id}', [PenggunaController::class, 'update'])->name('pengguna.update');
        Route::delete('delete/{id}', [PenggunaController::class, 'delete'])->name('pengguna.delete');
    });
    Route::prefix('/kegiatan')->group(function () {
        Route::get('/', [KegiatanController::class, 'index'])->name('kegiatan');
        Route::post('/store', [KegiatanController::class, 'store'])->name('kegiatan.store');
        Route::put('update/{id}', [KegiatanController::class, 'update'])->name('kegiatan.update');
        Route::delete('delete/{id}', [KegiatanController::class, 'delete'])->name('kegiatan.delete');
        Route::post('/storeDokumentasi', [KegiatanController::class, 'storeDokumentasi'])->name('dokumentasi.store');
        Route::delete('deleteDokumentasi/{id}', [KegiatanController::class, 'deleteDokumentasi'])->name('dokumentasi.delete');
    });
    Route::prefix('/keuangan')->group(function () {
        Route::get('/', [KeuanganController::class, 'index'])->name('keuangan');
        Route::post('/store', [KeuanganController::class, 'store'])->name('keuangan.store');
        Route::put('update/{id}', [KeuanganController::class, 'update'])->name('keuangan.update');
        Route::delete('delete/{id}', [KeuanganController::class, 'delete'])->name('keuangan.delete');
    });
    Route::prefix('/anggota')->group(function () {
        Route::get('/', [AnggotaController::class, 'index'])->name('anggota');
        Route::post('/store', [AnggotaController::class, 'store'])->name('anggota.store');
        Route::put('update/{id}', [AnggotaController::class, 'update'])->name('anggota.update');
        Route::delete('delete/{id}', [AnggotaController::class, 'delete'])->name('anggota.delete');
    });
    

    Route::get('/about', function () {
        return view('about');
    })->name('about');
});