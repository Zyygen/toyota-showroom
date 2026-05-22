<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CarModelController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\ContactManageController;
use Carbon\Carbon;

// 1. Route Front-end (Khách hàng)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/contact-submit', [ContactController::class, 'submitForm'])->name('contact.submit');
Route::get('/deposit/secure/{token}', [ContactController::class, 'showDepositForm'])->name('deposit.form');
Route::post('/deposit/secure/{token}', [ContactController::class, 'submitDeposit'])->name('deposit.submit');
Route::get('/xe/{slug}', [HomeController::class, 'show'])->name('car.detail');

// 2. Nhóm Route của hệ thống (Breeze) - Bắt buộc giữ tên mặc định
Route::middleware('auth')->group(function () {
    
    // Trang Dashboard (Tên route bắt buộc phải là 'dashboard')
    Route::get('/dashboard', function () {
        $today = Carbon::today();
        $startOfWeek = Carbon::now()->startOfWeek();
        $startOfMonth = Carbon::now()->startOfMonth();

        // 1. Thống kê Lượt Yêu cầu tư vấn (Dựa vào ngày tạo - created_at)
        $reqToday = \App\Models\Contact::whereDate('created_at', $today)->count();
        $reqWeek = \App\Models\Contact::whereBetween('created_at', [$startOfWeek, Carbon::now()])->count();
        $reqMonth = \App\Models\Contact::whereBetween('created_at', [$startOfMonth, Carbon::now()])->count();

        // 2. Thống kê Lượt Khách chốt cọc (Dựa vào ngày cập nhật - updated_at và trạng thái paid)
        $paidToday = \App\Models\Contact::where('payment_status', 'paid')->whereDate('updated_at', $today)->count();
        $paidWeek = \App\Models\Contact::where('payment_status', 'paid')->whereBetween('updated_at', [$startOfWeek, Carbon::now()])->count();
        $paidMonth = \App\Models\Contact::where('payment_status', 'paid')->whereBetween('updated_at', [$startOfMonth, Carbon::now()])->count();

        // Số liệu tồn kho xe
        $totalModels = \App\Models\CarModel::query()->count();
        $totalCars = \App\Models\Car::query()->count();

        return view('dashboard', compact(
            'reqToday', 'reqWeek', 'reqMonth', 
            'paidToday', 'paidWeek', 'paidMonth',
            'totalModels', 'totalCars'
        ));
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
    // Thêm hình ảnh mô tả tính năng
    Route::post('/car-models/{id}/features', [CarModelController::class, 'storeFeature'])->name('car_models.features.store');
    Route::delete('/car-features/{id}', [CarModelController::class, 'destroyFeature'])->name('car_models.features.destroy');

    // Quản lý Phiên bản xe
    Route::get('/cars', [CarController::class, 'index'])->name('cars.index');
    Route::get('/cars/create', [CarController::class, 'create'])->name('cars.create');
    Route::post('/cars', [CarController::class, 'store'])->name('cars.store');
    Route::get('/cars/{id}/edit', [CarController::class, 'edit'])->name('cars.edit');
    Route::put('/cars/{id}', [CarController::class, 'update'])->name('cars.update');
    Route::delete('/cars/{id}', [CarController::class, 'destroy'])->name('cars.destroy');

    // Quản lý Khách hàng liên hệ
    Route::get('/contacts', [ContactManageController::class, 'index'])->name('contacts.index');
    Route::post('/contacts/{id}/status', [ContactManageController::class, 'updateStatus'])->name('contacts.status');
    Route::delete('/contacts/{id}', [ContactManageController::class, 'destroy'])->name('contacts.destroy');
    Route::post('/contacts/{id}/confirm', [ContactController::class, 'confirmConsultation'])->name('contacts.confirm');
    Route::post('/contacts/{id}/confirm-deposit', [ContactManageController::class, 'confirmDeposit'])->name('contacts.confirm_deposit');
});

// Bắt buộc giữ lại file auth.php của hệ thống đăng nhập
require __DIR__.'/auth.php';