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

Route::get('/', function () {
    return view('welcome');
});


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

//untuk menu toko
Route::get('/daftar-toko', [TokoController::class, 'daftar_toko'])->name('daftar-toko')->middleware(['auth', 'admin']);
Route::get('/tambah-toko', [TokoController::class, 'tambah_toko'])->name('tambah-toko')->middleware(['auth', 'admin']);
Route::post('/simpan-toko', [TokoController::class, 'simpan_toko'])->name('simpan-toko')->middleware(['auth', 'admin']);
Route::get('/edit-toko/{id_toko}', [TokoController::class, 'edit_toko'])->name('edit-toko')->middleware(['auth', 'admin']);
Route::post('/update-toko/{id_toko}', [TokoController::class, 'update_toko'])->name('update-toko')->middleware(['auth', 'admin']);
Route::delete('/delete-toko/{id_toko}', [TokoController::class, 'delete_toko'])->name('delete-toko')->middleware(['auth', 'admin']);
Route::get('/download-barcode/{id_toko}', [TokoController::class, 'download_barcode'])->name('download-barcode')->middleware(['auth', 'admin']);

//untuk menu transaksi
Route::get('/harga', [TransaksiController::class, 'harga'])->name('harga')->middleware(['auth', 'admin']);
Route::get('/tambah-harga', [TransaksiController::class, 'tambah_harga'])->name('tambah-harga')->middleware(['auth', 'admin']);
Route::post('/simpan-harga', [TransaksiController::class, 'simpan_harga'])->name('simpan-harga')->middleware(['auth', 'admin']);
Route::delete('delete-harga/{id_harga}', [TransaksiController::class, 'delete_harga'])->name('delete-harga')->middleware(['auth', 'admin']);
Route::get('/faktur-terima-barang', [TransaksiController::class, 'faktur_terima_barang'])->name('faktur-terima-barang')->middleware(['auth', 'admin']);
Route::get('/faktur-pembayaran', [TransaksiController::class, 'faktur_pembayaran'])->name('faktur-pembayaran')->middleware(['auth', 'admin']);




//untuk tampilan users
Route::get('/users', [UserController::class, 'users'])->name('users');
Route::get('/profile', [UserController::class, 'profile'])->name('profile');
Route::get('/kunjungan', [UserController::class, 'kunjungan'])->name('kunjungan');
Route::get('/toko-sales', [UserController::class, 'toko_sales'])->name('toko-sales');
