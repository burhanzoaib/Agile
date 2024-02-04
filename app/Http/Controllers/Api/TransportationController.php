<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transportation;
use Illuminate\Support\Facades\DB;

class TransportationController extends Controller
{
    public function index()
    {
        $transportation = Transportation::with(['time' => function ($query) {
            $query->where('package_name', 'transportation');
        },'rating' => function ($query) {
            $query->where('activity_type', 'transportation');
        }])->get();
        return response()->json(['data' => $transportation], 200, [], JSON_PRETTY_PRINT);
    }


    public function booking(Request $request){
        return  $request->all();
    }

    public function show($id)
    {
        $transportation = Transportation::find($id);

        if (!$transportation) {
            return response()->json(['error' => 'Transportation not found'], 404);
        }

        return response()->json(['data' => $transportation], 200);
    }
}
