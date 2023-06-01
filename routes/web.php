<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\TestimoniController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

//auth
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout']);

Route::get('auth_member', [AuthController::class, 'index2'])->name('auth_member');
Route::post('login_member', [AuthController::class, 'login_member']);
Route::get('logout_member', [AuthController::class, 'logout_member']);
Route::post('register_member', [AuthController::class, 'register_member']);

Route::get('/kategori', [CategoryController::class, 'list']);
Route::get('/subkategori', [SubcategoryController::class, 'list']);
Route::get('/slider', [SliderController::class, 'list']);
Route::get('/produk', [ProductController::class, 'list']);
Route::get('/member', [MemberController::class, 'list']);
Route::get('/testimoni', [TestimoniController::class, 'list']);
Route::get('/review', [ReviewController::class, 'list']);

Route::get('/pesananBaru', [OrderController::class, 'listBaru']);
Route::get('/pesananDikonfirmasi', [OrderController::class, 'listDikonfirmasi']);
Route::get('/pesananDikemas', [OrderController::class, 'listDikemas']);
Route::get('/pesananDikirim', [OrderController::class, 'listDikirim']);
Route::get('/pesananDiterima', [OrderController::class, 'listDiterima']);
Route::get('/pesananSelesai', [OrderController::class, 'listSelesai']);

Route::get('dashboard', [DashboardController::class, 'index']);
