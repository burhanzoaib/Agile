<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    public $guarded=[];
    public function cityTour()
    {
        return $this->belongsTo(Citytour::class,'activity_id')->with('packagetime','rating');
    }

    public function attraction()
    {
        return $this->belongsTo(Attraction::class, 'activity_id')->with('packagetime','rating');
    }

    public function adventure()
    {
        return $this->belongsTo(Adventure::class, 'activity_id')->with('packagetime','rating');
    }
    public function viptransportation()
    {
        return $this->belongsTo(Viptransportation::class, 'activity_id')->with('packagetime','rating');
    }
    public function transportation()
    {
        return $this->belongsTo(Transportation::class, 'activity_id')->with('packagetime','rating');
    }


    public function rating(){
        return $this->hasMany(Review::class,"activity_id","id");
    }
}
