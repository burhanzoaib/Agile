<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;


class ReviewsController extends Controller
{
    public function __construct(){
        $this->section = new \stdClass();
        $this->section->title = 'Reviews';
        $this->section->heading = 'Reviews';
        $this->section->slug = 'Reviews';
        $this->section->folder = 'reviews';
    }
    public function index()
    {
        if(\Auth::user()->can('reviews list')) {
            $section = $this->section;
            $review = Review::all();
            return view($section->folder . '.index', compact('section', 'review'));
            
        }else{
            abort(403,'Dont have access');
        }
    }

    public function show($id)
    {
        $section=$this->section;
        $review=Review::where('id',$id)->first();
        return view($section->folder.'.show',compact('section','review'));
    }

    public function destroy($id)
    {
        
        $review = Review::findOrFail($id);
    
        
        $review->delete();
        session()->flash('success', 'Deleted successfully');
        return redirect()->route('review.index');
    }

}
