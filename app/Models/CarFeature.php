<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class CarFeature extends Model
{
    protected $guarded = [];
    
    public function car_model() {
        return $this->belongsTo(CarModel::class);
    }
}
