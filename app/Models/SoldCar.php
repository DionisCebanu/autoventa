<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoldCar extends Model
{
    use HasFactory;

    protected $table = 'sold_cars';

    protected $fillable = [
        'car_id',
        'name',
        'surname',
        'email',
        'phone',
        'sold_price',
        'sold_date',
    ];

    /**
     * Relation avec la voiture vendue
     */
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
