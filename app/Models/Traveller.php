<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traveller extends Model
{
    use HasFactory;
    public $guarded=[];

    // public function flightData()
    // {
    //     return $this->belongsToMany(FlightData::class);
    // }
}
