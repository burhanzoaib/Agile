<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use Redirect;

class SettingController extends Controller
{

    public function __construct(){
        $this->section = new \stdClass();
        $this->section->title = 'Setting';
        $this->section->heading = 'Setting';
        $this->section->slug = 'Setting';
        $this->section->folder = 'setting';
    }

    public function edit()
    {
        $section=$this->section;
        $setting=Setting::first();
        $section->method = 'post';
        return view($section->folder.'.form',compact('section','setting'));
    }



    public function setting_update($id, Request $request)
    {
        // if (\Auth::user()->can('setting settingUpdate')) {
    
        // Retrieve all input data from the request
        $data = $request->all();
    
        // Handle image upload
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = $imageFile->getClientOriginalName();
    
            $imagePath = $imageFile->move('public/settings/images', $imageName);
    
            $imageURLs = asset('public/settings/images/' . $imageName);
            $data['image'] = $imageURLs;
        }
    
        // Update the database with the provided data
        Setting::where('id', $id)->update($data);
    
        return Redirect::back()->withErrors(['msg' => 'Updated Successfully!']);
    
        // } else {
        //     abort('405');
        // }
    }
    




}
