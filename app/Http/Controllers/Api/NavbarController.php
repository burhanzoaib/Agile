<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Navbar;

class NavbarController extends Controller
{
    public function index()
    {
        $NavbarData = Navbar::all(); 
        return response()->json($NavbarData);
    }
}
