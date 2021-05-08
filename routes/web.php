<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
});

Route::view('dashboard', 'dashboard')->name('dashboard');

Route::prefix('advokasi')->group(function () {
    Route::view('jenisperkara', 'advokasi.jenisperkara')->name('jenisperkara');
    Route::view('kajianhukum', 'advokasi.kajianhukum')->name('kajianhukum');
    Route::view('referensiperaturan', 'advokasi.referensi')->name('referensiperaturan');
    Route::view('kalenderkegiatan', 'advokasi.kalenderkegiatan')->name('kalenderkegiatan');
    Route::view('penangananperkara', 'advokasi.penangananperkara')->name('penangananperkara');
    Route::view('pendapathukum', 'advokasi.pendapathukum')->name('pendapathukum');
    Route::view('pendampingan', 'advokasi.pendampingan')->name('pendampingan');
});

Route::prefix('aparatpemeriksa')->group(function () {
    Route::view('statustinjut', 'aparatpemeriksa.statustinjut')->name('statustinjut');
    Route::view('aparatpemeriksa', 'aparatpemeriksa.aparatpemeriksa')->name('aparatpemeriksa');
});

Route::prefix('referensi')->group(function () {
    Route::view('unitdja', 'referensi.unit')->name('unitdja');
    Route::view('user', 'referensi.user')->name('user');
});
