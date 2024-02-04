<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Vector extends Model
{
    use HasFactory;
    protected $fillable=['order_name','numbers_of_colors','format','turnaround_time','instruction','image_file','user_id','status'
    ,'admin_file','amount','mainfilezip','is_payment','refrence_id','is_resell','resell_refrence','new_sell','saller_id','smm'];
    
    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
    public function invoice(){
        return $this->hasOne(Invoice::class,'order_no','id');
    }

    public function getcount($id){
        $users = Vector:: select('resell_refrence',DB::raw('count(is_resell) as is_resell'))
        ->where('resell_refrence',$id)
        ->groupBy('resell_refrence')
        ->first();
        return $users ? $users->is_resell : 0;
       
    }
	
	public function image($id){
		$vector = Vector::where('id',$id)->first();
		$array = json_decode($vector->image_file);
		if(isset($array)){
			foreach($array as $image){   
				$qw[] = asset('public/public/images/'.$image);
			}
			return $qw;
		}else{
			return null;
		}
		
	}
}
