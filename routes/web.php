<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KurikulumController;
use App\Http\Controllers\KompetensiController;
use App\Http\Controllers\ElemenKompetensiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::resource('/', DashboardController::class);
Route::get('dashboard', [DashboardController::class, 'index'])->name('depan.index');

Route::get('kurikulum', [KurikulumController::class, 'index'])->name('depan.kurikulum');
Route::get('kompetensi', [KompetensiController::class, 'index'])->name('depan.kompetensi');
Route::get('elemenkompetensi', [ElemenKompetensiController::class, 'index'])->name('depan.elemenkompetensi');

// routes/web.php
Route::get('/search', [SearchController::class, 'search'])->name('search');

//Kurikulum
Route::get('create', [KurikulumController::class, 'create'])->name('kurikulum.create');
Route::post('/createkurikulum', [KurikulumController::class, 'store'])->name('kurikulum.store');
Route::get('show/{id}', [KurikulumController::class, 'show'])->name('kurikulum.show');
Route::get('edit/{id}', [KurikulumController::class, 'edit'])->name('kurikulum.edit');
Route::put('update/{id}', [KurikulumController::class, 'update'])->name('kurikulum.update');
Route::delete('destroy/{kode_diklat}', [KurikulumController::class, 'destroy'])->name('kurikulum.destroy');

//Kompetensi
Route::prefix('show/{id_pelatihan}')->group(function () {
    Route::get('/create', [KompetensiController::class, 'create'])->name('kompetensi.create');
    Route::post('kompetensi', [KompetensiController::class, 'store'])->name('kompetensi.store');
    Route::get('/{kode_kompetensi}', [KompetensiController::class, 'show'])->name('kompetensi.show');
    Route::get('/{kode_kompetensi}/edit', [KompetensiController::class, 'edit'])->name('kompetensi.edit');
    Route::put('/{kode_kompetensi}', [KompetensiController::class, 'update'])->name('kompetensi.update');
    Route::delete('/{kode_kompetensi}', [KompetensiController::class, 'destroy'])->name('kompetensi.destroy');

    /* Elemen Kompetensi */
    Route::prefix('/{kode_kompetensi}')->group(function () {
        Route::get('elemen-kompetensi/create', [ElemenKompetensiController::class, 'create'])->name('elemen_kompetensi.create');
        Route::post('elemen-kompetensi', [ElemenKompetensiController::class, 'store'])->name('elemen_kompetensi.store');
        Route::get('elemen-kompetensi/{kode_elemen}/edit', [ElemenKompetensiController::class, 'edit'])->name('elemen_kompetensi.edit');
        Route::put('elemen-kompetensi/{kode_elemen}', [ElemenKompetensiController::class, 'update'])->name('elemen_kompetensi.update');
        Route::delete('elemen-kompetensi/{kode_elemen}', [ElemenKompetensiController::class, 'destroy'])->name('elemen_kompetensi.destroy');

        /* Kriteria */
        Route::prefix('elemen-kompetensi/{kode_elemen}')->group(function () {
            Route::get('kriteria', [KriteriaController::class, 'show'])->name('kriteria.show');
            Route::get('kriteria/create', [KriteriaController::class, 'create'])->name('kriteria.create');
            Route::post('kriteria', [KriteriaController::class, 'store'])->name('kriteria.store');
            Route::get('kriteria/{id}/edit', [KriteriaController::class, 'edit'])->name('kriteria.edit');
            Route::put('kriteria/{id}', [KriteriaController::class, 'update'])->name('kriteria.update');
            Route::delete('kriteria/{id}', [KriteriaController::class, 'destroy'])->name('kriteria.destroy');
        });
    });
});
