<?php

namespace App\Http\Controllers;

use App\Models\CarModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $carModels = CarModel::with('cars')->get();
        return view('home', compact('carModels'));
    }
    
    public function show($slug)
    {
        // Tìm dòng xe dựa theo slug, lấy kèm luôn danh sách các phiên bản của nó
        $carModel = CarModel::with('cars')->where('slug', $slug)->firstOrFail();
        
        return view('car_detail', compact('carModel'));
    }
}