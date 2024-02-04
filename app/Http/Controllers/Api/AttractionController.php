<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Attraction;
use Illuminate\Support\Facades\DB;

class AttractionController extends Controller
{
    public function index()
    {
        $Attraction = Attraction::with(['time' => function ($query) {
            $query->where('package_name', 'attraction');
        },'rating' => function ($query) {
            $query->where('activity_type', 'Attraction');
        }])->get();

        return response()->json(['data' => $Attraction], 200, [], JSON_PRETTY_PRINT);
    }


    public function booking(Request $request){
        return  $request->all();
    }


    public function show($id)
    {
        $Attraction = Attraction::find($id);

        if (!$Attraction) {
            return response()->json(['error' => 'Attraction not found'], 404);
        }

        return response()->json(['data' => $Attraction], 200);
    }

}
