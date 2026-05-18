<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    protected $guarded = [];

    // Một dòng xe (CarModel) có nhiều phiên bản (Car)
    public function cars()
    {
        return $this->hasMany(Car::class);
    }
}
