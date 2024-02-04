<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    public $guarded=[];

    public function cityTour()
{
    return $this->hasOne(Citytour::class,'id','activity_id');
}
public function attraction()
{
    return $this->hasOne(Attraction::class,'id','activity_id');
}
public function adventure()
{
    return $this->hasOne(Adventure::class,'id','activity_id');
}
public function Viptransportation()
{
    return $this->hasOne(Viptransportation::class,'id','activity_id');
}
public function transportation()
{
    return $this->hasOne(Transportation::class,'id','activity_id');
}
    public function booking_item()
    {
            return $this->hasMany(BookingItem::class,'booking_id','id');
//            dd($query);
//        if ($query === 'some_condition') {
//                $query->where('booking_items.some_column', '=', 'some_value');
//            } elseif ($condition === 'another_condition') {
//                $query->where('other_table1.another_column', '>', 100);
//            };
    }

public function Time()
{
    return $this->hasOne(Time::class,'id','time');
}
    // public function cityTour(){
    //     return $this->hasOne(Citytour::class,'id','activity_id');
    // }
    // public function attraction(){
    //     return $this->hasOne(Attraction::class,'id','activity_id');
    // }
    // public function adventure() {
    //     return $this->hasOne(Adventure::class,'id','activity_id');
    // }
}
