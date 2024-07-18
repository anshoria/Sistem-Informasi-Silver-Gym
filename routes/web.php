<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginAdminController;
use App\Http\Controllers\DashboardPTController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\Profil_Member_Controller;
use App\Http\Controllers\DashboardProfilController;
use App\Http\Controllers\DashboardPresensiController;
use App\Http\Controllers\Dashboard_Laporan_Controller;
use App\Http\Controllers\DashboardTransaksiController;
use App\Http\Controllers\Dashboard_Settings_Controller;
use App\Http\Controllers\Forgot_Password_Controller;
use App\Http\Controllers\Presensi_Member;

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

Route::get('/', [HomeController::class, 'index'])->middleware('guest');
Route::get('/Halaman-member', [HomeController::class, 'member'])->middleware('member')->name('HOME');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'store']);

Route::get('/admin', [LoginAdminController::class, 'index'])->name('login-admin')->middleware('GuestAdmin');
Route::post('/admin', [LoginAdminController::class, 'store']);
Route::post('/adminlogout', [LoginAdminController::class, 'logout']);

Route::post('/Logout', [LoginController::class, 'logout']);

Route::get('/forgot-password', [Forgot_Password_Controller::class, 'index'])->middleware('guest');
Route::post('/forgot-password', [Forgot_Password_Controller::class, 'forgot_password'])->middleware('guest');
Route::get('/reset-password/{token}', [Forgot_Password_Controller::class, 'reset_password'])->middleware('guest')->name('password.reset');
Route::post('/reset-password', [Forgot_Password_Controller::class, 'update_password'])->middleware('guest');

Route::get('/Register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/Register', [RegisterController::class, 'store']);

Route::resource('/profil', Profil_Member_Controller::class)->except('create', 'store', 'show', 'destroy')->middleware('member');

Route::post('/presensi', [HomeController::class, 'storePresensi'])->middleware('member');

// presensi member
Route::get('/presensi-minggu', [Presensi_Member::class, 'minggu_ini'])->middleware('member');
Route::get('/presensi-bulan', [Presensi_Member::class, 'bulan_ini'])->middleware('member');
Route::get('/presensi-tahun', [Presensi_Member::class, 'tahun_ini'])->middleware('member');
Route::get('/presensi-semua', [Presensi_Member::class, 'semua'])->middleware('member');

// admin dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('admin');

Route::resource('/dashboard/profil', DashboardProfilController::class)->middleware('admin')->except('create', 'store', 'show', 'destroy');

Route::put('/dashboard/update-password', [DashboardController::class, 'update_password'])->middleware('admin');

Route::get('/dashboard/settings', [Dashboard_Settings_Controller::class, 'settings'])->middleware('admin');

Route::post('/dashboard/gallery', [Dashboard_Settings_Controller::class, 'gallery'])->middleware('admin');

Route::put('/dashboard/settings/edit/{id}', [Dashboard_Settings_Controller::class, 'pricelist_edit'])->middleware('admin');

Route::delete('/dashboard/gallery/delete', [Dashboard_Settings_Controller::class, 'deletegallery'])->middleware('admin');

Route::resource('/dashboard/member', DashboardUserController::class)->except('show')->middleware('admin');

Route::resource('/dashboard/personal_trainer', DashboardPTController::class)->except('show')->middleware('admin');

Route::resource('/dashboard/presensi', DashboardPresensiController::class)->except('show', 'edit', 'update')->middleware('admin');

Route::resource('/dashboard/transaksi', DashboardTransaksiController::class)->except('show')->middleware('admin');

Route::resource('/dashboard/admin', DashboardAdminController::class)->except('show')->middleware('admin');

Route::get('/dashboard/laporan-transaksi', [Dashboard_Laporan_Controller::class, 'index_transaksi'])->middleware('admin');

Route::post('/dashboard/laporan-transaksi', [Dashboard_Laporan_Controller::class, 'laporan_transaksi'])->middleware('admin');

Route::get('/dashboard/laporan-member', [Dashboard_Laporan_Controller::class, 'index_member'])->middleware('admin');

Route::post('/dashboard/laporan-member', [Dashboard_Laporan_Controller::class, 'laporan_member'])->middleware('admin');

Route::get('/dashboard/cetak-transaksi', [Dashboard_Laporan_Controller::class, 'cetak_laporan_transaksi'])->middleware('admin');

Route::get('/dashboard/cetak-member', [Dashboard_Laporan_Controller::class, 'cetak_laporan_member'])->middleware('admin');

Route::get('/dashboard/notif-member', [DashboardController::class, 'notif'])->middleware('admin');
Route::post('/dashboard/notif-member/confirm/{id}', [DashboardController::class, 'confirm'])->middleware('admin');
Route::post('/dashboard/notif-member/reject/{id}', [DashboardController::class, 'reject'])->middleware('admin');
