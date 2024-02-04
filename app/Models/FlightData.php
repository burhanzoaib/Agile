<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightData extends Model
{
    use HasFactory;
    public $guarded=[];

    public function travellers()
    {
        return $this->hasmany(Traveller::class,'flight_id','id');
    }

}
