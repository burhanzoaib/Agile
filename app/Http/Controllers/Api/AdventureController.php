<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Adventure;
use Illuminate\Support\Facades\DB;

class AdventureController extends Controller
{
    public function index()
    {
        $adventure = Adventure::with(['time' => function ($query) {
            $query->where('package_name', 'adventure');
        },'rating' => function ($query) {
            $query->where('activity_type', 'Adventure');
        }])->get();
        return response()->json(['data' => $adventure], 200, [], JSON_PRETTY_PRINT);
    }


    public function booking(Request $request){
        return  $request->all();
    }

    public function show($id)
    {
        $adventure = Adventure::find($id);

        if (!$adventure) {
            return response()->json(['error' => 'Adventure not found'], 404);
        }

        return response()->json(['data' => $adventure], 200);
    }
}
