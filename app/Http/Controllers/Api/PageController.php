<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Setting;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function page($slug)
    {
        $page = Page::where('slug',$slug)->first();
        return response()->json(['data' => $page], 200, [], JSON_PRETTY_PRINT);
    }

    public function all_page_name()
    {
        $page = Page::select('page_heading','slug')->get();
        return response()->json(['data' => $page], 200, [], JSON_PRETTY_PRINT);
    }

    public function getLogo(){

        $logo = Setting::where('id',1)->first();
        if($logo){
            return $logo->image;
        }
        return "https://cdn.icon-icons.com/icons2/2570/PNG/512/image_icon_153794.png";
    }


}
