<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\TestimoniController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/katalog', [HomeController::class, 'katalog']);

Route::get('/beforeCart/{id}', [CartController::class, 'before']);
Route::post('/addCart', [CartController::class, 'store']);
Route::get('/cart', [CartController::class, 'index']);
Route::get('/cart/{id}', [CartController::class, 'destroy']);
Route::get('/cartPlus/{id}', [CartController::class, 'plus']);
Route::get('/cartMinus/{id}', [CartController::class, 'minus']);

Route::get('/checkout', [PaymentController::class, 'index']);
Route::get('/payment', [PaymentController::class, 'payment']);
Route::get('/invoice/{id}', [PaymentController::class, 'invoice']);
Route::get('/history', [PaymentController::class, 'history']);
Route::get('/history/{id}', [PaymentController::class, 'history_detail']);

Route::post('/addreview', [PaymentController::class, 'buat_review']);
Route::get('/diterima/{id}', [PaymentController::class, 'diterima']);
Route::get('/selesai/{id}', [PaymentController::class, 'selesai']);
Route::get('/dikemas/{id}', [PaymentController::class, 'dikemas']);
Route::get('/dikirim/{id}', [PaymentController::class, 'dikirim']);
Route::get('/dikonfirmasi/{id}', [PaymentController::class, 'dikonfirmasi']);

//auth
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout']);

Route::get('login_member', [AuthController::class, 'login_member']);
Route::post('login_member', [AuthController::class, 'login_member_action']);
Route::get('logout_member', [AuthController::class, 'logout_member']);

Route::get('register_member', [AuthController::class, 'register_member']);
Route::post('register_member', [AuthController::class, 'register_member_action']);

Route::get('/kategori', [CategoryController::class, 'list']);
Route::get('/subkategori', [SubcategoryController::class, 'list']);
Route::get('/slider', [SliderController::class, 'list']);
Route::get('/produk', [ProductController::class, 'list']);
Route::get('/member', [MemberController::class, 'list']);
Route::get('/testimoni', [TestimoniController::class, 'list']);
Route::get('/review', [ReviewController::class, 'list']);

Route::get('/pesanan', [OrderController::class, 'list']);
Route::get('/pesananBaru', [OrderController::class, 'listBaru']);
Route::get('/pesananDikonfirmasi', [OrderController::class, 'listDikonfirmasi']);
Route::get('/pesananDikemas', [OrderController::class, 'listDikemas']);
Route::get('/pesananDikirim', [OrderController::class, 'listDikirim']);
Route::get('/pesananDiterima', [OrderController::class, 'listDiterima']);
Route::get('/pesananSelesai', [OrderController::class, 'listSelesai']);
Route::get('/pesananDetail/{id}', [OrderController::class, 'detail']);

Route::get('/dashboard', [DashboardController::class, 'index']);

Route::get('/laporan', [OrderController::class, 'laporan']);
Route::get('/filterLaporan', [OrderController::class, 'filterLaporan']);
