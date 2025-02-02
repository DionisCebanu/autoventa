<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'make',
        'model',
        'year',
        'type',
        'transmission',
        'fuel_type',
        'mileage',
        'fuel_efficiency',
        'engine_size',
        'horsepower',
        'price',
        'vin',
        'availability_status',
        'seat_capacity',
        'drive_type',
        'car_condition',
    ];

    /**
     * Relationship: A car has many images.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images() {
        return $this->hasMany(Image::class);
    }
}
