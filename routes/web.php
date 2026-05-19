<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CarModelController;
use App\Http\Controllers\Admin\CarController;

// 1. Route Front-end (Khách hàng)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/contact-submit', [ContactController::class, 'submitForm'])->name('contact.submit');
Route::get('/xe/{slug}', [HomeController::class, 'show'])->name('car.detail');

// 2. Nhóm Route của hệ thống (Breeze) - Bắt buộc giữ tên mặc định
Route::middleware('auth')->group(function () {
    
    // Trang Dashboard (Tên route bắt buộc phải là 'dashboard')
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Quản lý Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 3. Nhóm Route chuyên biệt cho Quản trị viên (Admin)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Quản lý xe
    Route::get('/car-models', [CarModelController::class, 'index'])->name('car_models.index');
    Route::get('/car-models/create', [CarModelController::class, 'create'])->name('car_models.create');
    Route::post('/car-models', [CarModelController::class, 'store'])->name('car_models.store');
    Route::get('/car-models/{id}/edit', [CarModelController::class, 'edit'])->name('car_models.edit');
    Route::put('/car-models/{id}', [CarModelController::class, 'update'])->name('car_models.update');
    Route::delete('/car-models/{id}', [CarModelController::class, 'destroy'])->name('car_models.destroy');

    // Quản lý Phiên bản xe
    Route::get('/cars', [CarController::class, 'index'])->name('cars.index');
    Route::get('/cars/create', [CarController::class, 'create'])->name('cars.create');
    Route::post('/cars', [CarController::class, 'store'])->name('cars.store');
    Route::get('/cars/{id}/edit', [CarController::class, 'edit'])->name('cars.edit');
    Route::put('/cars/{id}', [CarController::class, 'update'])->name('cars.update');
    Route::delete('/cars/{id}', [CarController::class, 'destroy'])->name('cars.destroy');
});

// Bắt buộc giữ lại file auth.php của hệ thống đăng nhập
require __DIR__.'/auth.php';