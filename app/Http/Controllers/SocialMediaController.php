<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SocialMediaLink;
use Illuminate\Support\Facades\DB;



class SocialMediaController extends Controller
{
    public function __construct(){
        $this->section = new \stdClass();
        $this->section->title = 'SocialMedia';
        $this->section->heading = 'SocialMedia';
        $this->section->slug = 'SocialMedia';
        $this->section->folder = 'socialmedia';
    }

    public function index()
    {
        $section=$this->section;
        $socialmedia=SocialMediaLink::get();
        return view($section->folder.'.index',compact('section','socialmedia'));
    }
    public function show($id)
    {
        $section=$this->section;
        $socialmedia=SocialMediaLink::where('id',$id)->first();
        return view($section->folder.'.show',compact('section','socialmedia'));
    }
    public function edit($id)
    {
        $section=$this->section;
        $socialmedia=SocialMediaLink::where('id',$id)->first();
        return view($section->folder.'.edit',compact('section','socialmedia'));
    }
    public function update(Request $request, $id)
{
    $socialmedia = $request->validate([
        'name' => 'required',
        'link' => 'required',

    ]);
   
    if ($request->hasFile('images')) {
        $imageURLs = [];

        foreach ($request->file('images') as $imageFile) {
            $imageName = $imageFile->getClientOriginalName(); // Get the original image name

            // Move the uploaded image to the storage location
            $imagePath = $imageFile->move('public/socialmediaicons/images', $imageName);

            // Generate the URL for the saved image
            $imageURLs[] = asset('public/socialmediaicons/images/' . $imageName);
        }

        // Update the 'images' column in the 'citytours' table with the new image URLs
        DB::table('social_media_links')
            ->where('id', $id)
            ->update(['images' => json_encode($imageURLs)]);
    }
  
    SocialMediaLink::where('id', $id)->update($socialmedia);

    session()->flash('success', ' Updated successfully');
    return redirect()->route('SocialMedia.index');
}


public function destroy($id)
{
    
    $socialmedia = SocialMediaLink::findOrFail($id);

    
    $socialmedia->delete();
    session()->flash('success', 'Deleted successfully');
    return redirect()->route('SocialMedia.index');
}
}
