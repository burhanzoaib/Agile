<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    use HasFactory;
    public $table="time_ci";
    public $guarded=[];
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
