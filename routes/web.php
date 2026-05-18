<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CarModelController;

// 1. Route Front-end (Khách hàng)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/contact-submit', [ContactController::class, 'submitForm'])->name('contact.submit');

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
});

// Bắt buộc giữ lại file auth.php của hệ thống đăng nhập
require __DIR__.'/auth.php';