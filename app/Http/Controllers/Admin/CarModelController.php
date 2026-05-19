<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\CarFeature;

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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            // Thêm validate cho các trường mới
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'tagline' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $carModel = new CarModel();
        $carModel->name = $request->name;
        $carModel->slug = Str::slug($request->name);
        
        // Lưu các thông tin mới
        $carModel->tagline = $request->tagline;
        $carModel->description = $request->description;

        // Giữ nguyên logic lưu ảnh cũ của bạn
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('car_models', 'public');
            $carModel->image = Storage::url($imagePath);
        }

        // Thêm logic lưu ảnh banner
        if ($request->hasFile('banner_image')) {
            $bannerPath = $request->file('banner_image')->store('car_models_banners', 'public');
            $carModel->banner_image = Storage::url($bannerPath);
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
            'name' => 'required|string|max:255|unique:car_models,name,' . $id, 
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:2048',
            // Thêm validate cho các trường mới
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:4096',
            'tagline' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $carModel->name = $request->name;
        $carModel->slug = \Illuminate\Support\Str::slug($request->name);
        
        // Cập nhật thông tin mới
        $carModel->tagline = $request->tagline;
        $carModel->description = $request->description;

        // Xử lý cập nhật ảnh đại diện (giữ nguyên logic của bạn)
        if ($request->hasFile('image')) {
            if ($carModel->image) {
                $oldImagePath = str_replace('/storage/', '', $carModel->image);
                Storage::disk('public')->delete($oldImagePath);
            }
            $imagePath = $request->file('image')->store('car_models', 'public');
            $carModel->image = '/storage/' . $imagePath;
        }

        // Xử lý cập nhật ảnh banner
        if ($request->hasFile('banner_image')) {
            // Xóa banner cũ nếu có
            if ($carModel->banner_image) {
                $oldBannerPath = str_replace('/storage/', '', $carModel->banner_image);
                Storage::disk('public')->delete($oldBannerPath);
            }
            $bannerPath = $request->file('banner_image')->store('car_models_banners', 'public');
            $carModel->banner_image = '/storage/' . $bannerPath;
        }

        $carModel->save();

        return redirect()->route('admin.car_models.index')->with('success', 'Cập nhật dòng xe thành công!');
    }

    // 6. Xóa dòng xe
    public function destroy($id)
    {
        $carModel = CarModel::findOrFail($id);

        // Xóa ảnh đại diện
        if ($carModel->image) {
            $imagePath = str_replace('/storage/', '', $carModel->image);
            Storage::disk('public')->delete($imagePath);
        }

        // Xóa ảnh banner
        if ($carModel->banner_image) {
            $bannerPath = str_replace('/storage/', '', $carModel->banner_image);
            Storage::disk('public')->delete($bannerPath);
        }

        $carModel->delete();

        return redirect()->route('admin.car_models.index')->with('success', 'Đã xóa dòng xe!');
    }

    public function storeFeature(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|in:ngoai_that,noi_that,van_hanh,an_toan',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $feature = new CarFeature($request->except('image'));
        $feature->car_model_id = $id;
        
        $imagePath = $request->file('image')->store('car_features', 'public');
        $feature->image = '/storage/' . $imagePath;
        
        $feature->save();

        return back()->with('success', 'Đã thêm 1 tính năng mới!');
    }

    public function destroyFeature($id)
    {
        $feature = CarFeature::findOrFail($id);
        if ($feature->image) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $feature->image));
        }
        $feature->delete();

        return back()->with('success', 'Đã xóa tính năng!');
    }
}