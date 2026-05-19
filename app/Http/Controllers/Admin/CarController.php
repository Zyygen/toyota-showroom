<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\CarModel;
use Illuminate\Http\Request;

class CarController extends Controller
{
    // 1. Hiển thị danh sách phiên bản
    public function index()
    {
        // Dùng with('car_model') để tối ưu truy vấn lấy tên dòng xe
        $cars = Car::with('car_model')->orderBy('created_at', 'desc')->get();
        return view('admin.cars.index', compact('cars'));
    }

    // 2. Hiển thị Form thêm mới
    public function create()
    {
        // Lấy danh sách dòng xe để hiển thị ở ô Select (Dropdown)
        $carModels = CarModel::all();
        return view('admin.cars.create', compact('carModels'));
    }

    // 3. Xử lý lưu dữ liệu
    public function store(Request $request)
    {
        $request->validate([
            'car_model_id' => 'required|exists:car_models,id',
            'variant_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'fuel_type' => 'required|in:petrol,hybrid',
            'year' => 'required|integer|min:2000|max:' . (date('Y') + 1),
        ]);

        Car::create($request->all());

        return redirect()->route('admin.cars.index')->with('success', 'Đã thêm phiên bản xe mới!');
    }
    
    // 4. Hiển thị Form Sửa
    public function edit($id)
    {
        $car = Car::findOrFail($id);
        $carModels = CarModel::all(); // Lấy danh sách dòng xe để đưa vào thẻ Select
        return view('admin.cars.edit', compact('car', 'carModels'));
    }

    // 5. Xử lý Cập nhật dữ liệu
    public function update(Request $request, $id)
    {
        $car = Car::findOrFail($id);

        $request->validate([
            'car_model_id' => 'required|exists:car_models,id',
            'variant_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'fuel_type' => 'required|in:petrol,hybrid',
            'year' => 'required|integer|min:2000|max:' . (date('Y') + 1),
        ]);

        $car->update($request->all());

        return redirect()->route('admin.cars.index')->with('success', 'Cập nhật thông tin phiên bản thành công!');
    }

    // 6. Xóa phiên bản
    public function destroy($id)
    {
        $car = Car::findOrFail($id);
        $car->delete();

        return redirect()->route('admin.cars.index')->with('success', 'Đã xóa phiên bản xe!');
    }
}
