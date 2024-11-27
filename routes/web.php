<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParkirMasukController;
use App\Http\Controllers\ParkirKeluarController;
use App\Http\Controllers\DashboardController;
use App\Exports\ParkirExport;
use Maatwebsite\Excel\Facades\Excel;
// Store parking data
Route::post('/parkir-masuk', [ParkirMasukController::class, 'store'])->name('parkir.masuk.store');

// Halaman utama (Dashboard)
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Menampilkan data parkir masuk
Route::get('/parkir-masuk', [ParkirMasukController::class, 'index'])->name('parkir.masuk.index');

// Halaman parkir keluar
Route::get('/parkir-keluar', [ParkirKeluarController::class, 'index'])->name('parkir.keluar');
Route::post('/parkir-keluar/proses', [ParkirKeluarController::class, 'proses'])->name('parkir.keluar.proses');

// Halaman untuk menampilkan data parkir (dataparkir) - Menampilkan data parkir masuk dan keluar (final)
Route::get('/dataparkir', [ParkirKeluarController::class, 'dataparkir'])->name('dataparkir');

Route::get('/export-parkir', function () {
    return Excel::download(new ParkirExport, 'data-parkir.xlsx');
})->name('export.parkir');