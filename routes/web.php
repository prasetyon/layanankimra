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

Route::get('/', ['as' => '/', 'uses' => 'AuthController@index']);
Route::get('login', ['as' => 'login', 'uses' => 'AuthController@index']);
Route::post('login', ['as' => 'login', 'uses' => 'AuthController@login']);
Route::get('logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);
Route::get('aduan', ['as' => 'aduan', 'uses' => 'PengaduanController@index']);
Route::post('aduan', ['as' => 'aduan', 'uses' => 'PengaduanController@store']);

Route::middleware('loggedin:admin,es4,es3,es2,user')->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::view('notifikasi', 'notifikasi')->name('notifikasi');
});

Route::prefix('advokasi')->group(function () {
    Route::middleware('loggedin:admin')->group(function () {
        Route::view('jenisperkara', 'advokasi.jenisperkara')->name('jenisperkara');
        Route::view('kajianhukum', 'advokasi.kajianhukum')->name('kajianhukum');
        Route::view('referensiperaturan', 'advokasi.referensi')->name('referensiperaturan');
    });

    Route::middleware('loggedin:admin,es4,es3,es2,user')->group(function () {
        Route::get('kalenderkegiatan', ['as' => 'kalenderkegiatan', 'uses' => 'AdvokasiController@kalender']);
        Route::view('penangananperkara', 'advokasi.penangananperkara')->name('penangananperkara');
        Route::view('pendapathukum', 'advokasi.pendapathukum')->name('pendapathukum');
        Route::view('pendampingan', 'advokasi.pendampingan')->name('pendampingan');
    });
});

Route::prefix('pengaduan')->group(function () {
    Route::middleware('loggedin:admin')->group(function () {
        Route::view('jenisaduan', 'pengaduan.jenisaduan')->name('jenisaduan');
    });

    Route::middleware('loggedin:admin,es4,es3,es2,user')->group(function () {
        Route::view('pengaduan', 'pengaduan.pengaduan')->name('pengaduan');
    });
});

Route::prefix('pengendalianinternal')->group(function () {
    // Route::middleware('loggedin:admin')->group(function () {
    //     Route::view('jenisaduan', 'pengaduan.jenisaduan')->name('jenisaduan');
    // });

    Route::middleware('loggedin:admin,es4,es3,es2,user')->group(function () {
        Route::view('epite', 'pengendalianintern.epite')->name('epite');
        Route::view('ppita', 'pengendalianintern.ppita')->name('ppita');
        Route::view('pipk', 'pengendalianintern.pipk')->name('pipk');
    });
});

Route::prefix('manajemenrisiko')->group(function () {
    Route::middleware('loggedin:admin')->group(function () {
        Route::view('sasaranorganisasi', 'manajemenrisiko.sasaranorganisasi')->name('sasaranorganisasi');
    });

    Route::middleware('loggedin:admin,es4,es3,es2,user')->group(function () {
        Route::view('piagamrisiko', 'manajemenrisiko.piagamrisiko')->name('piagamrisiko');
        Route::view('profilrisiko', 'manajemenrisiko.profilrisiko')->name('profilrisiko');
        Route::view('mitigasirisiko', 'manajemenrisiko.mitigasirisiko')->name('mitigasirisiko');
    });
});

Route::prefix('pemeriksaan')->group(function () {
    Route::middleware('loggedin:admin,es4,es3,es2,user')->group(function () {
        Route::view('tinjut', 'aparatpemeriksa.tinjut')->name('tinjut');
        Route::view('pemeriksaan', 'aparatpemeriksa.pengawasan')->name('pengawasan');
    });

    Route::middleware('loggedin:admin')->group(function () {
        Route::view('jenispengawasan', 'aparatpemeriksa.jenispengawasan')->name('jenispengawasan');
        Route::view('statustinjut', 'aparatpemeriksa.statustinjut')->name('statustinjut');
        Route::view('aparatpemeriksa', 'aparatpemeriksa.aparatpemeriksa')->name('aparatpemeriksa');
    });
});

Route::prefix('referensi')->group(function () {
    Route::middleware('loggedin:admin')->group(function () {
        Route::view('unitdja', 'referensi.unit')->name('unitdja');
        Route::view('user', 'referensi.user')->name('user');
    });
});
