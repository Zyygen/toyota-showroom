<?php

namespace App\Http\Controllers;

use App\Models\CarModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Lấy tất cả các dòng xe kèm theo các phiên bản của chúng
        $carModels = CarModel::with('cars')->get();
        
        return view('home', compact('carModels'));
    }
}