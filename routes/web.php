<?php

use App\Http\Controllers\GajiController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\JenisPotonganController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\RekapAbsensiController;
use App\Http\Controllers\UserController;
use App\Models\JenisPotongan;
use App\Models\RekapAbsensi;
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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();


Route::middleware(['auth'])->group(function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::middleware(['can:is_admin'])->group(function () {
        Route::resource('user', UserController::class);
        Route::resource('jabatan', JabatanController::class);
        Route::resource('potongan', JenisPotonganController::class);      
        Route::controller(RekapAbsensiController::class)->group(function () {
            Route::prefix('rekap/absensi')->group(function () {
                Route::post('/', 'addRekap')->name('rekap.add');
                Route::get('/', 'showRekapData')->name('rekap.show');
                Route::get('delete', 'deleteRekapData')->name('rekap.delete');
                Route::get('karyawan', 'dataKaryawan')->name('rekap.datakaryawan');
                Route::post('store', 'store')->name('rekap.store');
            });
        });
    });
    Route::resource('presensi', PresensiController::class);
    Route::get('/cuti', [PresensiController::class, 'cuti'])->name('cuti');
    Route::get('/pulang/{id}', [PresensiController::class, 'pulang'])->name('pulang');
    Route::resource('gaji', GajiController::class);
    Route::get('/rekap/presensi-data', [RekapAbsensiController::class, 'getPresensiData'])->name('rekap.presensiData');
});
