<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
class BookingController extends Controller
{
    public function __construct(){
        $this->section = new \stdClass();
        $this->section->title = 'Booking';
        $this->section->heading = 'Booking';
        $this->section->slug = 'Booking';
        $this->section->folder = 'booking';
    }

    public function index()
    {
        $section=$this->section;
        $booking=Booking::all();
       return view($section->folder.'.index',compact('section','booking'));

    }
    public function show($id)
    {
        $section=$this->section;
        $booking = Booking::with('booking_item')->where('id',$id)->first();
        //dd($booking);
        return view($section->folder.'.show',compact('section','booking'));
    }
}
