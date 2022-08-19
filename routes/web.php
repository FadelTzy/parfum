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
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\CetakController;
use App\Http\Controllers\CostumerController;
use App\Models\Costumer;

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
        //Transaksi
        Route::get('/transaksi', [TransaksiController::class, 'index'])->name('admin.transak');
        Route::get('/riwayat-transaksi', [TransaksiController::class, 'riwayat'])->name('admin.riwayat');
        Route::get('/riwayat-transaksi/{id}', [TransaksiController::class, 'riwayat2']);

        Route::post('/transaksi/simpan', [TransaksiController::class, 'simpan'])->name('admin.simpan');
        Route::post('/transaksi/bayar', [TransaksiController::class, 'bayar'])->name('admin.bayar');
        Route::delete('/transaksi/{id}', [TransaksiController::class, 'delete']);

        //basketing
        Route::post('/basket/save', [TransaksiController::class, 'basketsave'])->name('admin.basketsave');
        Route::post('/basket/remove', [TransaksiController::class, 'basketremove'])->name('admin.basketremove');
        Route::post('/basket/remove2', [TransaksiController::class, 'basketremove2'])->name('admin.basketremove2');
        Route::post('/basket/editharga', [TransaksiController::class, 'basketeditharga'])->name('admin.basketeditharga');
        Route::post('/basket/editdiskon', [TransaksiController::class, 'basketeditdiskon'])->name('admin.basketeditdiskon');

        Route::get('/basket/check', [TransaksiController::class, 'check']);
        Route::post('/basket', [TransaksiController::class, 'basket'])->name('admin.basket');
        Route::get('/cart/{id}', [TransaksiController::class, 'cart'])->name('admin.cart');


        //produk
        Route::get('/data-barang', [BarangController::class, 'barang'])->name('barang.index');
        Route::post('/data-barang', [BarangController::class, 'store'])->name('barang.store');
        Route::post('/data-barang/import', [BarangController::class, 'import'])->name('barang.import');
        Route::get('/data-barang/export', [BarangController::class, 'export'])->name('barang.export');

        Route::post('/data-barang/edit', [BarangController::class, 'update'])->name('barang.update');
        Route::delete('/data-barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');

        //customer
        Route::get('/data-customer', [CostumerController::class, 'customer'])->name('customer.index');
        Route::post('/data-customer', [CostumerController::class, 'store'])->name('customer.store');
        Route::post('/data-customer/edit', [CostumerController::class, 'update'])->name('customer.update');
        // Route::delete('/data-barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');

        Route::get('/', [Controller::class, 'index'])->name('admin.dashboard');

        Route::get('/profile', [Controller::class, 'profil'])->name('admin.profil');

        //getduit
        Route::post('/getduit', [Controller::class, 'getduit'])->name('admin.getduit');

        //cetak
        Route::get('/cetak/nota/{id}', [CetakController::class, 'nota'])->name('admin.cetaknota');


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

        //data admin
        Route::post('/data-admin', [user::class, 'adminsave'])->name('data.adminsave');
        Route::put('/data-admin', [user::class, 'adminedit'])->name('data.adminedit');
        Route::delete('/data-admin/{a}', [user::class, 'adminhapus'])->name('data.adminhapus');
        Route::get('/data-admin', [user::class, 'admin'])->name('data.admin');
        //pelanggan
        Route::get('/daftar-pelanggan', [user::class, 'pelanggan'])->name('data.pelanggan');

    });
});

//admin



Route::get('/', function () {
    return redirect()->route('login');
});



require __DIR__ . '/auth.php';
