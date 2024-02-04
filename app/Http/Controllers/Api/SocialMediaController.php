<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialMediaLink;
use App\Models\Bannerslider;



class SocialMediaController extends Controller
{
    public function index()
    {
        $socialMediaData = SocialMediaLink::all(); 
        return response()->json($socialMediaData);
    }
    public function bannerslider()
    {
        $bannerslider = Bannerslider::all(); 
        return response()->json($bannerslider);
    }
}
