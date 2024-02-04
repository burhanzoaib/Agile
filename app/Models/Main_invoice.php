<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Main_invoice extends Model
{
    protected $guarded=[];
	protected $table="main_invoice";

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
    public function dorder(){
        return $this->hasOne(Digitizing::class,'id','order_no');
    }
    public function vorder(){
        return $this->hasOne(Vector::class,'id','order_no');
    }
}