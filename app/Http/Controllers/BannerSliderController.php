<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bannerslider;
use Illuminate\Support\Facades\DB;


class BannerSliderController extends Controller
{
    public function __construct(){
        $this->section = new \stdClass();
        $this->section->title = 'Banner Slider';
        $this->section->heading = 'Banner Slider';
        $this->section->slug = 'Banner Slider';
        $this->section->folder = 'bannerslider';
    }
    public function index()
    {
        if(\Auth::user()->can('bannersliders list')) {
            $section = $this->section;
            $bannerslider = Bannerslider::all();
            return view($section->folder . '.index', compact('section', 'bannerslider'));
        }else{
            abort(403,'Dont have access');
        }
    }

    public function create()
    {
        if(\Auth::user()->can('bannersliders create')) {
            $section=$this->section;
            $bannerslider=Bannerslider::get();
            return view($section->folder.'.form',compact('section','bannerslider'));
        }else{
            abort(403,'Dont have access');
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'bannername' => 'required|max:255',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                $imageName = $imageFile->getClientOriginalName();
                $imagePath = $imageFile->move('public/bannerslider/images', $imageName);
                $imageURLs[] = asset('public/bannerslider/images/' . $imageName);
            }
        }
        $im=json_encode($imageURLs);
        $BannerI=Bannerslider::create([
            'bannername' => $validatedData['bannername'],
            'images' => $im,

        ]);
        session()->flash('success', 'Banner Slider created successfully');
        return redirect()->route('banner.index');
    }


    public function edit($id)
    {
        if(\Auth::user()->can('bannersliders edit')) {
            $section=$this->section;
        $bannerslider=Bannerslider::where('id',$id)->first();
        return view($section->folder.'.edit',compact('section','bannerslider'));
        }else{
            abort(403,'Dont have access');
        }
    }



    public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'bannername' => 'required',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);


    // If new images are uploaded, process them
    if ($request->hasFile('images')) {
      
        $banner = Bannerslider::findOrFail($id);

        if ($validatedData['bannername'] === 'Home') {
            $imageURLs = json_decode($banner->images, true) ?? [];

            foreach ($request->file('images') as $imageFile) {
                $imageName = $imageFile->getClientOriginalName();
                $imagePath = $imageFile->move('public/bannerslider/images', $imageName);
                $imageURLs[] = asset('public/bannerslider/images/' . $imageName);
            }

            $banner->images = json_encode($imageURLs);
        } else {

            foreach ($request->file('images') as $imageFile) {
                $imageName = $imageFile->getClientOriginalName();
                $imagePath = $imageFile->move('public/bannerslider/images', $imageName);
                $imageURLs[] = asset('public/bannerslider/images/' . $imageName);
            }            
            $singleImage = reset($imageURLs); 
            $banner->images = json_encode([$singleImage]);
        }
    }

    $banner->bannername = $validatedData['bannername'];
    $banner->save();

    session()->flash('success', 'Banner Slider updated successfully');
    return redirect()->route('banner.index');
}

    




    public function deleteImage($id, $index)
    {
        $bannerslider = Bannerslider::findOrFail($id);
    
        $images = json_decode($bannerslider->images, true);
    
        if (isset($images[$index])) {
       
            array_splice($images, $index, 1);
            $bannerslider->update(['images' => json_encode($images)]);
    
            session()->flash('success', 'Image deleted successfully');
        } else {
            
            session()->flash('error', 'Image not found for deletion');
        }
    
        return redirect()->back()->with(['success'=>'Deleted successfully']);

    }
    



    public function show($id)
    {
        $section=$this->section;
        $bannerslider=Bannerslider::where('id',$id)->first();
        return view($section->folder.'.show',compact('section','bannerslider'));
    }

    public function destroy($id)
    {
        
        $bannerslider = Bannerslider::findOrFail($id);
    
        
        $bannerslider->delete();
        session()->flash('success', 'Deleted successfully');
    }


}
