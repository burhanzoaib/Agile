<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $guarded=[];
    // public function getOrderTypeAttribute($value)
    // {
        
    //     return "DDD";
    // }

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
    public function dorder(){
        return $this->hasOne(Digitizing::class,'id','order_no');
    }
    public function vorder(){
        return $this->hasOne(Vector::class,'id','order_no');
    }



    // public function order($value){
        
    //     return $value;
    //     if($this->order_type == 'Digitizing'){
    //         return $this->hasOne(Digitizing::class,'id','order_no');
    //     }else{
    //         return $this->hasOne(Vector::class,'id','order_no');
    //     }
    // }
}
