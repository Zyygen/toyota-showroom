<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CarModelController extends Controller
{
    // 1. Hiển thị danh sách các dòng xe
    public function index()
    {
        $carModels = CarModel::orderBy('created_at', 'desc')->get();
        return view('admin.car_models.index', compact('carModels'));
    }

    // 2. Hiển thị form tạo dòng xe mới
    public function create()
    {
        return view('admin.car_models.create');
    }

    // 3. Lưu thông tin dòng xe mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $carModel = new CarModel();
        $carModel->name = $request->name;
        $carModel->slug = Str::slug($request->name);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('car_models', 'public');
            $carModel->image = Storage::url($imagePath);
        }

        $carModel->save();

        return redirect()->route('admin.car_models.index')->with('success', 'Dòng xe đã được tạo thành công.');
    }
    // 4. Hiển thị Form Sửa
    public function edit($id)
    {
        $carModel = CarModel::findOrFail($id);
        return view('admin.car_models.edit', compact('carModel'));
    }

    // 5. Xử lý Cập nhật dữ liệu
    public function update(Request $request, $id)
    {
        $carModel = CarModel::findOrFail($id);

        $request->validate([
            // Bỏ qua ID hiện tại khi check trùng tên
            'name' => 'required|string|max:255|unique:car_models,name,' . $id, 
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $carModel->name = $request->name;
        $carModel->slug = \Illuminate\Support\Str::slug($request->name);

        // Nếu người dùng upload ảnh mới
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ trong thư mục (để tránh rác server)
            if ($carModel->image) {
                $oldImagePath = str_replace('/storage/', '', $carModel->image);
                Storage::disk('public')->delete($oldImagePath);
            }

            // Lưu ảnh mới
            $imagePath = $request->file('image')->store('car_models', 'public');
            $carModel->image = '/storage/' . $imagePath;
        }

        $carModel->save();

        return redirect()->route('admin.car_models.index')->with('success', 'Cập nhật dòng xe thành công!');
    }

    // 6. Xóa dòng xe
    public function destroy($id)
    {
        $carModel = CarModel::findOrFail($id);

        // Xóa ảnh vật lý trên server trước khi xóa dữ liệu
        if ($carModel->image) {
            $imagePath = str_replace('/storage/', '', $carModel->image);
            Storage::disk('public')->delete($imagePath);
        }

        $carModel->delete();

        return redirect()->route('admin.car_models.index')->with('success', 'Đã xóa dòng xe!');
    }
}
