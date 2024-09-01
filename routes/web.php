<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\KunjunganController;
use App\Models\Kunjungan;
use App\Models\Toko;
use App\Http\Middleware\RedirectIfNotSales;

// Route::get('/', function () {
//     return view('login');
// });
Route::get('/', [LoginController::class, 'index'])->name('login');

// Rute tanpa middleware
Route::get('/login', [LoginController::class, 'form_login'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Rute untuk user
Route::get('/login-sales', [LoginController::class, 'form_login_sales'])->name('login-sales');
Route::post('/login-sales', [LoginController::class, 'authenticate_user']);
Route::get('/logout-user', [LoginController::class, 'logout_user'])->name('logout-user');

//untuk menu admin
Route::get('/admin', [AdminController::class, 'index'])->name('admin');
//untuk menu dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(['auth', 'admin']);
Route::get('/cek', [DashboardController::class, 'cek'])->name('cek')->middleware(['auth', 'admin']);

//untuk menu barang
Route::get('/tambah-item', [ItemController::class, 'tambah_item'])->name('tambah-item')->middleware(['auth', 'admin']);
Route::get('/daftar-item', [ItemController::class, 'daftar_item'])->name('daftar-item')->middleware(['auth', 'admin']);
Route::post('/simpan-item', [ItemController::class, 'simpan_item'])->name('simpan-item')->middleware(['auth', 'admin']);
Route::get('/edit-item/{id_item}', [ItemController::class, 'edit_item'])->name('edit-item')->middleware(['auth', 'admin']);
Route::post('/update-item/{id}', [ItemController::class, 'update_item'])->name('update-item')->middleware(['auth', 'admin']);
Route::delete('/delete-item/{id_item}', [ItemController::class, 'delete_item'])->name('delete-item')->middleware(['auth', 'admin']);

Route::get('/stok-barang', [ItemController::class, 'stok_barang'])->name('stok-barang')->middleware(['auth', 'admin']);
Route::get('/tambah-stok', [ItemController::class, 'tambah_stok'])->name('tambah-stok')->middleware(['auth', 'admin']);
Route::get('/riwayat-stok', [ItemController::class, 'riwayat_stok'])->name('riwayat-stok')->middleware(['auth', 'admin']);
Route::post('/simpan-stok', [ItemController::class, 'simpan_stok'])->name('simpan-stok')->middleware(['auth', 'admin']);
Route::delete('/delete-stok/{id_stok}', [ItemController::class, 'delete_stok'])->name('delete-stok')->middleware(['auth', 'admin']);

//untuk menu sales
Route::get('/tambah-sales', [SalesController::class, 'tambah_sales'])->name('tambah-sales')->middleware(['auth', 'admin']);
Route::post('/kirim-sales', [SalesController::class, 'kirim_sales'])->name('kirim-sales')->middleware(['auth', 'admin']);
Route::get('/edit-sales/{id_sales}', [SalesController::class, 'edit_sales'])->name('edit-sales')->middleware(['auth', 'admin']);
Route::post('/update-sales/{id_sales}', [SalesController::class, 'update_sales'])->name('update-sales')->middleware(['auth', 'admin']);
Route::delete('/delete-sales/{id_sales}', [SalesController::class, 'delete_sales'])->name('delete-sales')->middleware(['auth', 'admin']);
Route::get('/detail-sales/{id_sales}', [SalesController::class, 'detail_sales'])->name('detail-sales')->middleware(['auth', 'admin']);
Route::post('/update-pencapaian-sales/{id_sales}', [SalesController::class, 'update_pencapaian_sales'])->name('update-pencapaian-sales')->middleware(['auth', 'admin']);
Route::get('/pencarian-target-sales', [SalesController::class, 'pencarian_target_sales'])->name('pencarian-target-sales')->middleware(['auth', 'admin']);


Route::get('/daftar-sales', [SalesController::class, 'daftar_sales'])->name('daftar-sales')->middleware(['auth', 'admin']);
Route::get('/stok-sales', [SalesController::class, 'stok_sales'])->name('stok-sales')->middleware(['auth', 'admin']);
Route::get('/stok-masuk/{id_sales}', [SalesController::class, 'stok_masuk'])->name('stok-masuk')->middleware(['auth', 'admin']);
Route::post('/simpan-stok-sales', [SalesController::class, 'simpan_stok_sales'])->name('simpan-stok-sales')->middleware(['auth', 'admin']);
Route::get('/riwayat-stok-sales/{kode_sales}', [SalesController::class, 'riwayat_stok_sales'])->name('riwayat-stok-sales')->middleware(['auth', 'admin']);
Route::delete('/delete-stok-sales/{id_stok_sales}', [SalesController::class, 'delete_stok_sales'])->name('delete-stok-sales')->middleware(['auth', 'admin']);
Route::get('/riwayat-sales', [SalesController::class, 'riwayat_sales'])->name('riwayat-sales')->middleware(['auth', 'admin']);
Route::get('/return-stok-sales/{id_sales}', [SalesController::class, 'return_stok_sales'])->name('return-stok-sales')->middleware(['auth', 'admin']);
Route::post('/simpan-return-stok-sales', [SalesController::class, 'simpan_return_stok_sales'])->name('simpan-return-stok-sales')->middleware(['auth', 'admin']);

Route::get('/tambah-stok-sales', [SalesController::class, 'tambah_stok_sales'])->name('tambah-stok-sales')->middleware(['auth', 'admin']);
Route::get('/return-stok', [SalesController::class, 'return_stok'])->name('return-stok')->middleware(['auth', 'admin']);
Route::delete('/delete-return-stok/{id_return_stok}', [SalesController::class, 'delete_return_stok'])->name('delete-return-stok')->middleware(['auth', 'admin']);
Route::get('/tambah-return-stok', [SalesController::class, 'tambah_return_stok'])->name('tambah-return-stok')->middleware(['auth', 'admin']);
Route::get('/target-sales', [SalesController::class, 'target_sales'])->name('target-sales')->middleware(['auth', 'admin']);

//untuk menu toko
Route::get('/daftar-toko', [TokoController::class, 'daftar_toko'])->name('daftar-toko')->middleware(['auth', 'admin']);
Route::get('/tambah-toko', [TokoController::class, 'tambah_toko'])->name('tambah-toko')->middleware(['auth', 'admin']);
Route::post('/simpan-toko', [TokoController::class, 'simpan_toko'])->name('simpan-toko')->middleware(['auth', 'admin']);
Route::get('/edit-toko/{id_toko}', [TokoController::class, 'edit_toko'])->name('edit-toko')->middleware(['auth', 'admin']);
Route::get('/edit-capaian/{id_toko}', [TokoController::class, 'edit_capaian'])->name('edit-capaian')->middleware(['auth', 'admin']);
Route::post('/update-capaian/{id_toko}', [TokoController::class, 'update_capaian'])->name('update-capaian')->middleware(['auth', 'admin']);
Route::post('/update-toko/{id_toko}', [TokoController::class, 'update_toko'])->name('update-toko')->middleware(['auth', 'admin']);
Route::delete('/delete-toko/{id_toko}', [TokoController::class, 'delete_toko'])->name('delete-toko')->middleware(['auth', 'admin']);
Route::get('/download-barcode/{id_toko}', [TokoController::class, 'download_barcode'])->name('download-barcode')->middleware(['auth', 'admin']);
Route::get('/detail-toko/{id_toko}', [TokoController::class, 'detail_toko'])->name('detail-toko')->middleware(['auth', 'admin']);

//untuk menu transaksi
Route::get('/harga', [TransaksiController::class, 'harga'])->name('harga')->middleware(['auth', 'admin']);
Route::get('/tambah-harga', [TransaksiController::class, 'tambah_harga'])->name('tambah-harga')->middleware(['auth', 'admin']);
Route::get('/edit-harga/{id_harga}', [TransaksiController::class, 'edit_harga'])->name('edit-harga')->middleware(['auth', 'admin']);
Route::post('/simpan-harga', [TransaksiController::class, 'simpan_harga'])->name('simpan-harga')->middleware(['auth', 'admin']);
Route::post('/update-harga/{id_harga}', [TransaksiController::class, 'update_harga'])->name('update-harga')->middleware(['auth', 'admin']);
Route::delete('delete-harga/{id_harga}', [TransaksiController::class, 'delete_harga'])->name('delete-harga')->middleware(['auth', 'admin']);
Route::get('/faktur-terima-barang', [TransaksiController::class, 'faktur_terima_barang'])->name('faktur-terima-barang')->middleware(['auth', 'admin']);
Route::get('/faktur-pembayaran', [TransaksiController::class, 'faktur_pembayaran'])->name('faktur-pembayaran')->middleware(['auth', 'admin']);
Route::get('/detail-faktur-barang/{no_faktur_barang}', [TransaksiController::class, 'detail_faktur_barang'])->name('detail-faktur-barang')->middleware(['auth', 'admin']);
Route::get('/detail-faktur-bayar/{no_faktur_bayar}', [TransaksiController::class, 'detail_faktur_bayar'])->name('detail-faktur-bayar')->middleware(['auth', 'admin']);
Route::post('/update-faktur-bayar/{id_faktur}', [TransaksiController::class, 'update_faktur_bayar'])->name('update-faktur-bayar')->middleware(['auth', 'admin']);


//untuk tampilan user
Route::get('/users', [UserController::class, 'users'])->name('users');
Route::get('/profile', [UserController::class, 'profile'])->name('profile');
Route::get('/kunjungan', [UserController::class, 'kunjungan'])->name('kunjungan');

Route::middleware(['auth', 'sales'])->group(function () {
    Route::get('/toko-sales', [UserController::class, 'toko_sales'])->name('toko-sales');
});

// Route::get('/toko-sales', [UserController::class, 'toko_sales'])->name('toko-sales')->middleware(['auth','sales']);
Route::get('/tambah-toko-sales', [UserController::class, 'tambah_toko_sales'])->name('tambah-toko-sales');
Route::post('/simpan-toko-sales', [UserController::class, 'simpan_toko_sales'])->name('simpan-toko-sales');
Route::get('/stok-keluar-sales', [UserController::class, 'stok_keluar_sales'])->name('stok-keluar-sales');

Route::get('/stok-masuk-sales/{id_toko}', [UserController::class, 'stok_masuk_sales'])->name('stok-masuk-sales');
Route::get('/item-details/{kode_item}', [UserController::class, 'getItemDetails']);
Route::post('/simpan-faktur-barang', [UserController::class, 'simpan_faktur_barang'])->name('simpan-faktur-barang');
Route::get('/faktur-barang/{kode_toko}', [UserController::class, 'faktur_barang'])->name('faktur-barang');
Route::get('/faktur-bayar/{no_faktur_barang}', [UserController::class, 'faktur_bayar'])->name('faktur-bayar');
Route::get('/detail-faktur/{no_faktur_barang}', [UserController::class, 'detail_faktur'])->name('detail-faktur');
Route::post('/save-terjual/{id_faktur}', [UserController::class, 'saveTerjual'])->name('save-terjual');
Route::post('/save-return/{id_faktur}', [UserController::class, 'saveReturn'])->name('save-return');

Route::get('/app', [AppController::class, 'index'])->name('app');
Route::get('/app-toko-sales', [AppController::class, 'app_toko_sales'])->name('app-toko-sales');
Route::get('/app-faktur-barang/{kode_toko}', [AppController::class, 'app_faktur_barang'])->name('app-faktur-barang');
Route::get('/app-faktur-bayar/{no_faktur_barang}', [AppController::class, 'app_faktur_bayar'])->name('app-faktur-bayar');
Route::get('/app-tambah-toko', [AppController::class, 'app_tambah_toko'])->name('app-tambah-toko');
Route::post('/app-simpan-toko', [AppController::class, 'app_simpan_toko'])->name('app-simpan-toko');
Route::get('/app-tambah-stok/{id_toko}', [AppController::class, 'app_tambah_stok'])->name('app-tambah-stok');
Route::post('/app-simpan-stok', [AppController::class, 'app_simpan_stok'])->name('app-simpan-stok');
Route::post('/app-simpan-faktur-barang', [AppController::class, 'app_simpan_faktur_barang'])->name('app-simpan-faktur-barang');
Route::get('/app-detail-faktur-bayar/{no_faktur_barang}', [AppController::class, 'app_detail_faktur_bayar'])->name('app-detail-faktur-bayar');
Route::post('/app-save-terjual/{id_faktur}', [AppController::class, 'appSaveTerjual'])->name('app-save-terjual');
Route::post('/app-save-return/{id_faktur}', [AppController::class, 'appSaveReturn'])->name('app-save-return');

Route::get('/cetak-faktur-barang/{no_faktur_barang}', [AppController::class, 'cetak_faktur_barang'])->name('cetak-faktur-barang');
Route::get('/cetak-faktur-pembayaran/{no_faktur_barang}', [AppController::class, 'cetak_faktur_pembayaran'])->name('cetak-faktur-pembayaran');

Route::get('/app-cetak-faktur-barang/{no_faktur_barang}', [AppController::class, 'app_cetak_faktur_barang'])->name('app-cetak-faktur-barang');
Route::get('/app-cetak-faktur-pembayaran/{no_faktur_barang}', [AppController::class, 'app_cetak_faktur_pembayaran'])->name('app-cetak-faktur-pembayaran');

Route::get('/app-profile', [AppController::class, 'appProfile'])->name('app-profile');

Route::get('/app-kunjungan', [KunjunganController::class, 'appKunjungan'])->name('app-kunjungan');
Route::post('/app-simpan-kunjungan', [KunjunganController::class, 'appSimpanKunjungan'])->name('app-simpan-kunjungan');
// routes/web.php
Route::get('/get-toko/{id_toko}', [KunjunganController::class, 'getToko']);
Route::get('/app-daftar-kunjungan', [KunjunganController::class, 'appDaftarKunjungan'])->name('app-daftar-kunjungan');

Route::get('/app-logout', [AppController::class, 'appLogout'])->name('app-logout');
