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

Route::middleware('loggedin:admin,es4,es3,es2,user')->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
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

Route::prefix('aparatpemeriksa')->group(function () {
    Route::middleware('loggedin:admin')->group(function () {
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
