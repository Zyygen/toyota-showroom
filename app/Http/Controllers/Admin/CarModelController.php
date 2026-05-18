<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarModel;
use Illuminate\Http\Request;

class CarModelController extends Controller
{
    // Hiển thị danh sách các dòng xe
    public function index()
    {
        $carModels = CarModel::orderBy('created_at', 'desc')->get();
        return view('admin.car_models.index', compact('carModels'));
    }
}
