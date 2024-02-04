<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $guarded=[]; 
    
    public function user(){
        return $this->hasOne(User::class,'id','sender');
    }
}
