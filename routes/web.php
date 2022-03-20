<?php

use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\PegawaiController;
use App\Http\Controllers\Kasir\PembayaranController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\Waiter\EntriOrderController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Admin
Route::resource('pegawai', PegawaiController::class);
Route::resource('menu', MenuController::class);

//Waiter
Route::get('order', [EntriOrderController::class,'index'])->name('order');
Route::get('show-menu/{id}', [EntriOrderController::class, 'menu_show'])->name('show-menu');
Route::post('insert-menu', [EntriOrderController::class, 'add_menu_to_cart'])->name('insert-menu');
Route::get('delete-menu/{row_id}', [EntriOrderController::class, 'delete_menu_from_cart'])->name('delete-menu');
Route::post('insert-order', [EntriOrderController::class, 'simpan_transaksi'])->name('insert-order');

//Kasir
Route::resource('pembayaran', PembayaranController::class);

//Member
Route::resource('member', MemberController::class);

//Laporan
Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
