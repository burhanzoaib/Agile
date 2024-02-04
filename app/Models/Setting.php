<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Setting extends Model
{
    use HasFactory;
    public $guarded=[];
	// Protected $table="setting";
    // Protected $fillable=['stripe_key','stripe_secrate','admin_email','admin_phone','vat_tax','paypal_client_id','paypal_secret','pay_sendbox','address','content'];

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
    
}
