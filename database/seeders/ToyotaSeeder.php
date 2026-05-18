<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CarModel;
use App\Models\Car;

class ToyotaSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Tạo dòng xe Vios
        $vios = CarModel::create([
            'name' => 'Toyota Vios',
            'slug' => 'toyota-vios',
            'image' => 'https://via.placeholder.com/400x250?text=Toyota+Vios', 
        ]);

        // Tạo các phiên bản của Vios
        Car::create(['car_model_id' => $vios->id, 'variant_name' => '1.5E MT', 'price' => 458000000, 'fuel_type' => 'petrol', 'year' => 2024]);
        Car::create(['car_model_id' => $vios->id, 'variant_name' => '1.5G CVT', 'price' => 545000000, 'fuel_type' => 'petrol', 'year' => 2024]);

        // 2. Tạo dòng xe Camry
        $camry = CarModel::create([
            'name' => 'Toyota Camry',
            'slug' => 'toyota-camry',
            'image' => 'https://via.placeholder.com/400x250?text=Toyota+Camry',
        ]);

        // Tạo các phiên bản của Camry
        Car::create(['car_model_id' => $camry->id, 'variant_name' => '2.0G', 'price' => 1105000000, 'fuel_type' => 'petrol', 'year' => 2024]);
        Car::create(['car_model_id' => $camry->id, 'variant_name' => '2.5HV (Hybrid)', 'price' => 1495000000, 'fuel_type' => 'hybrid', 'year' => 2024]);
    }
}
