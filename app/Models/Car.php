<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $guarded = [];

    // Một phiên bản xe thuộc về một dòng xe (CarModel)
    public function car_model()
    {
        return $this->belongsTo(CarModel::class);
    }
}
