<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user;
use App\Http\Controllers\TTopikController;
use App\Http\Controllers\TPeriodeController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\cetak;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\SettingController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
//dosen
Route::group(['middleware' => ['auth']], function () {

    Route::prefix('admin')->group(function () {
        //produk
        Route::get('/data-barang', [BarangController::class, 'barang'])->name('barang.index');
        Route::post('/data-barang', [BarangController::class, 'store'])->name('barang.store');
        Route::post('/data-barang/edit', [BarangController::class, 'update'])->name('barang.update');
        Route::delete('/data-barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');

        Route::get('/', [Controller::class, 'index'])->name('admin.dashboard');

        Route::get('/profile', [Controller::class, 'profil'])->name('admin.profil');

        Route::get('/apa-aja/{a}', [Controller::class, 'rm2']);


        //setting
        Route::get('/data-setting', [SettingController::class, 'index'])->name('setting.index');
        Route::post('/data-setting', [SettingController::class, 'update'])->name('setting.update');


        //periode
        Route::get('/data-periode', [TPeriodeController::class, 'index'])->name('data.periode');
        Route::post('/data-periode', [TPeriodeController::class, 'store'])->name('data.periodesave');
        Route::put('/data-periode', [TPeriodeController::class, 'update'])->name('data.periodeedit');
        Route::delete('/data-periode/{a}', [TPeriodeController::class, 'destroy'])->name('data.periodehapus');

        Route::post('/foto-profile', [user::class, 'foto'])->name('user.foto');
        Route::post('/password-profile', [user::class, 'password'])->name('user.password');


        Route::post('/data-admin', [user::class, 'adminsave'])->name('data.adminsave');
        Route::post('/data-mahasiswa', [user::class, 'mahasiswasave'])->name('data.mahasiswasave');
        Route::post('/data-dosen', [user::class, 'dosensave'])->name('data.dosensave');

        Route::put('/data-admin', [user::class, 'adminedit'])->name('data.adminedit');
        Route::put('/data-mahasiswa', [user::class, 'mahasiswaedit'])->name('data.mahasiswaedit');
        Route::put('/data-dosen', [user::class, 'dosenedit'])->name('data.dosenedit');

        Route::delete('/data-admin/{a}', [user::class, 'adminhapus'])->name('data.adminhapus');
        Route::delete('/data-mahasiswa/{a}', [user::class, 'mahasiswahapus'])->name('data.mahasiswahapus');
        Route::delete('/data-dosen/{a}', [user::class, 'dosenhapus'])->name('data.dosenhapus');

        Route::get('/data-admin', [user::class, 'admin'])->name('data.admin');
        Route::get('/data-dosen', [user::class, 'dosen'])->name('data.dosen');
        Route::get('/data-mahasiswa', [user::class, 'mahasiswa'])->name('data.mahasiswa');
    });
});

//admin



Route::get('/', function () {
    return redirect()->route('login');
});



require __DIR__ . '/auth.php';
