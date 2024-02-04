<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FlightData;
use App\Models\Traveller;

class FlightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct(){
        $this->section = new \stdClass();
        $this->section->title = 'Flight Data';
        $this->section->heading = 'Flight Data';
        $this->section->slug = 'Flight Data';
        $this->section->folder = 'flightdata';
    }



    public function flightdata()
    {
        $section=$this->section;
        $flightdata = FlightData::with('travellers')->get();
        return view($section->folder.'.index',compact('section','flightdata'));
    }
    public function showflightdata($id)
    {
        $section=$this->section;
        $showflightdata = FlightData::with('travellers')->where('id', $id)->first();
        return view($section->folder.'.show',compact('section','showflightdata'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
