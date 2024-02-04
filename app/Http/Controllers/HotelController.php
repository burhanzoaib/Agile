<?php

namespace App\Http\Controllers;

use App\Models\AdminData;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function hotelbooking(){
        if(\Auth::user()->can('adminData list')){
            $adminData=AdminData::get();
            return view('hotelbooking.index',compact('adminData'));
        }else{
            abort(401);
        }
    }

    public function hotelDetail($id){
        if(\Auth::user()->can('adminData show')){
            $adminData=AdminData::where('id',$id)->first();
            return view('hotelbooking.show',compact('adminData'));
        }else{
            abort(401);
        }
    }
}
