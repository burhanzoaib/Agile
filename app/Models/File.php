<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class File extends Model
{
    use HasFactory;
    Protected $fillable=['name','ext','order_no','type'];
}