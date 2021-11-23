<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Costcenter extends Model
{
    use HasFactory;

    protected $fillable = [
        'cc_number', 'description',
    ];

    public function car()
    {
        //return $this->hasOne(Car::class);
    }
}
