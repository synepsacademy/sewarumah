<?php

use Illuminate\Support\Facades\Route;

// ==================== CONTROLLERS ====================
// User
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\KostController;
use App\Http\Controllers\User\CityController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\DetailController;

// Admin
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DatakostController;
use App\Http\Controllers\Admin\FasilitasController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\UsersController;

// Auth
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Booking
use App\Http\Controllers\BookingController;

// ==================== PUBLIC ROUTES ====================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/kost', [KostController::class, 'index'])->name('kost');
Route::get('/city/{id}', [CityController::class, 'showCity'])->name('city.show');
Route::get('/detail/{id}', [DetailController::class, 'show'])->name('detail.show');

// Auth (Login / Register)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// ==================== USER AUTH ROUTES ====================
Route::middleware(['auth'])->group(function () {
    // Order routes (user)
    Route::get('/order', [OrderController::class, 'index'])->name('order');
    Route::put('/orders/{id}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
    Route::put('/orders/{id}/upload-bukti', [OrderController::class, 'uploadBukti'])->name('order.uploadBukti');


    // Booking kost
    Route::post('/booking/{kost}', [BookingController::class, 'store'])->name('booking.store');
});

// ==================== ADMIN ROUTES ====================
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Kost
    Route::get('/datakost', [DatakostController::class, 'index'])->name('datakost');
    Route::post('/datakost', [DatakostController::class, 'store'])->name('datakost.store');
    Route::put('/datakost/{id}', [DatakostController::class, 'update'])->name('datakost.update');
    Route::delete('/datakost/{id}', [DatakostController::class, 'destroy'])->name('datakost.destroy');

    // Fasilitas
    Route::get('/fasilitas', [FasilitasController::class, 'index'])->name('fasilitas');
    Route::post('/fasilitas', [FasilitasController::class, 'store'])->name('fasilitas.store');
    Route::put('/fasilitas/{id}', [FasilitasController::class, 'update'])->name('fasilitas.update');
    Route::delete('/fasilitas/{id}', [FasilitasController::class, 'destroy'])->name('fasilitas.destroy');

    // Lokasi
    Route::get('/location', [LocationController::class, 'index'])->name('location');
    Route::post('/location', [LocationController::class, 'store'])->name('kota.store');
    Route::put('/location/{id}', [LocationController::class, 'update'])->name('kota.update');
    Route::delete('/location/{id}', [LocationController::class, 'destroy'])->name('kota.destroy');


    // Pesanan
    Route::get('/orders', [OrdersController::class, 'index'])->name('orders');
    Route::put('/orders/{id}/approve', [OrdersController::class, 'approve'])->name('orders.approve');
    Route::put('/orders/{id}/cancel', [OrdersController::class, 'cancel'])->name('orders.cancel');
    Route::put('/orders/{id}/cancel-note', [OrdersController::class, 'cancelWithNote'])->name('orders.cancelWithNote');


    // Pengguna
    Route::get('/users', [UsersController::class, 'index'])->name('users');
    Route::put('/users/{id}/deactivate', [UsersController::class, 'deactivate'])->name('users.deactivate');
    Route::put('/users/{id}/activate', [UsersController::class, 'activate'])->name('users.activate');
    Route::delete('/users/{id}', [UsersController::class, 'destroy'])->name('users.destroy');

});
