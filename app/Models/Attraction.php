<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attraction extends Model
{
    use HasFactory;
    public $guarded=[];

    public function time(){
        return $this->hasMany(Time::class,"package_id","id");
    }
    public function rating(){
        return $this->hasMany(Review::class,"activity_id","id");
    }

    public function packagetime(){
        return $this->hasMany(Time::class,"package_id","id")->where('package_name',"Attraction");
    }
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

}
