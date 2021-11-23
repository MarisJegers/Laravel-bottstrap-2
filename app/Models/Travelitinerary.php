<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Travelitinerary extends Model
{
    use HasFactory;

    protected $fillable = [
        'ti_nr',
        'date_start',
        'date_end',
        'user_id',
        'car_id',
        'odo_start',
        'odo_end',
        'total_fuel_l',
        'total_distance_km',
        'fuel_average',
        'distance_business',
        'distance_private', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
	/**
     * Viena ceļa zīme ir par vienu mašīnu 
     */
    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function journeys()
    {
        return $this->hasMany(Journey::class);
    }

}
