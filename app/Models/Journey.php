<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journey extends Model
{
    use HasFactory;

    protected $fillable = [
        'ti_nr_id',	
        'date',
        'position_start',
        'position_end',
        'trip_target',
        'distance_km',
        'type_private',
        'type_business',
        'cc_number_id',
    ];

    public function travelitinerary()
    {
        return $this->belongsTo(Travelitinerary::class);
    }
    /* šis brauciens pieder vienam izmaksu centram */
    public function costcenter()
    {
        //return $this->belongsTo(Costcenter::class, 'id', 'cc_number_id');
        return $this->hasOne(Costcenter::class, 'id', 'cc_number_id');
    }
}
