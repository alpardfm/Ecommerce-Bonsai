<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\TestimoniController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function(){
    Route::post('logins', [AuthController::class, 'login']);
    Route::post('logouts', [AuthController::class, 'logout']);
    Route::post('registerMember', [AuthController::class, 'register_member']);
    Route::post('loginMember', [AuthController::class, 'login_member']);
    Route::post('logoutMember', [AuthController::class, 'logout_member']);
});

Route::group([
    'middleware' => 'api'
], function(){
    Route::resources([
    'categories' => CategoryController::class,
    'subcategories' => SubcategoryController::class,
    'sliders' => SliderController::class,
    'products' => ProductController::class,
    'members' => MemberController::class,
    'testimonis' => TestimoniController::class,
    'reviews' => ReviewController::class,
    'orders' => OrderController::class
    ]);

    Route::get('order/list', [OrderController::class, 'pesanan']);
    Route::get('order/baru', [OrderController::class, 'baru']);
    Route::get('order/dikonfirmasi', [OrderController::class, 'dikonfirmasi']);
    Route::get('order/dikemas', [OrderController::class, 'dikemas']);
    Route::get('order/dikirim', [OrderController::class, 'dikirim']);
    Route::get('order/diterima', [OrderController::class, 'diterima']);
    Route::get('order/selesai', [OrderController::class, 'selesai']);
    Route::post('order/ubah_status/{order}', [OrderController::class, 'ubah_status']);

    Route::get('reports', [ReportController::class, 'index']);
});

Route::post('/midtrans-callback', [PaymentController::class, 'callback']);