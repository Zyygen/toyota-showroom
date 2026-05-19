<?php

namespace App\Http\Controllers;

use App\Models\CarModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $carModels = CarModel::with('cars')->get();

        // Lấy danh sách ID xe đã xem từ Session
        $viewedIds = session()->get('viewed_cars', []);
        $viewedCars = collect(); // Tạo mảng rỗng mặc định
        
        if (!empty($viewedIds)) {
            // Lấy thông tin các xe đã xem và giữ nguyên thứ tự (xe vừa xem lên đầu)
            $viewedCars = CarModel::whereIn('id', $viewedIds)
                ->get()
                ->sortBy(function($model) use ($viewedIds) {
                    return array_search($model->id, $viewedIds);
                });
        }

        // Truyền thêm biến $viewedCars ra ngoài view
        return view('home', compact('carModels', 'viewedCars'));
    }
    
    public function show($slug)
    {
        $carModel = CarModel::with('cars')->where('slug', $slug)->firstOrFail();

        // --- LOGIC LƯU LỊCH SỬ XEM XE ---
        $viewed = session()->get('viewed_cars', []);
        // Thêm ID xe vừa xem vào đầu mảng
        array_unshift($viewed, $carModel->id);
        // Xóa các ID bị trùng (nếu khách xem lại xe cũ)
        $viewed = array_unique($viewed);
        // Chỉ giữ lại tối đa 4 xe gần nhất cho gọn
        $viewed = array_slice($viewed, 0, 4);
        // Cập nhật lại vào Session
        session()->put('viewed_cars', $viewed);
        // --------------------------------

        return view('car_detail', compact('carModel'));
    }
}