<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $fillable = [

        'reg_nr', 
        'make',
        'model',
        'fuel_type',
        'prod_year',
        'fuel_cons_factory',
        'purchase_date',
        'cc_number_id',
        'description',

    ];
    /* šis auto pieder vienam izmaksu centram */
    public function costcenter()
    {
        //return $this->belongsTo(Costcenter::class, 'id', 'cc_number_id');
        return $this->hasOne(Costcenter::class, 'id', 'cc_number_id');
    }

    public function travelitinerary()
    {
        return $this->hasOne(Travelitinerary::class);
    }
    // šis nestrādā
    protected $casts = [
        'created_at' => 'date:ddmmYYYY',
        'updated_at' => 'datetime:d-m-Y'
    ];


}




            