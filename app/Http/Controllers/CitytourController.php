<?php

namespace App\Http\Controllers;

use App\Models\Adventure;
use App\Models\Attraction;
use App\Models\Citytour;
use App\Models\Booking;
use App\Models\Time;
use App\Models\Viptransportation;
use App\Models\Transportation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CitytourController extends Controller
{
    public function __construct(){
        $this->section = new \stdClass();
        $this->section->title = 'City Tour';
        $this->section->heading = 'City Tour';
        $this->section->slug = 'cityTour';
        $this->section->folder = 'cityTour';
    }
    public function index()
    {
        if(\Auth::user()->can('citytour list')) {
            $section = $this->section;
            $tourPackage = Citytour::all();
            return view($section->folder . '.index', compact('section', 'tourPackage'));
            // return response()->json(['data' => $tourPackages]);
        }else{
            abort(403,'Dont have access');
        }
    }
    public function create()
    {
        if(\Auth::user()->can('citytour create')) {
            $section=$this->section;
            $tourPackage=Citytour::get();
            return view($section->folder.'.form',compact('section','tourPackage'));
        }else{
            abort(403,'Dont have access');
        }
    }
    public function store(Request $request)
    {
        // Validate the incoming data (including image field)
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'singleLineDetail' => 'required',
            'totalDays' => 'required',
            'tour_type_section' => 'required',
            'ageRestriction' => 'nullable|numeric',
            'newPrice' => 'required|numeric',
            'oldPrice' => 'nullable|numeric',
            'fromDate' => 'required|date',
            // 'promoCode' => 'required',
            'howManyPeople' => 'nullable',
            'images.*' => 'nullable|image',
            'front_images.*' => 'nullable|image', // Adjust image validation rules as needed // Adjust image validation rules as needed
            // 'time' => 'required',
            'longDetail' => 'required',
            'highlights' => 'required',
            'full_decription' => 'required',
            'includes' => 'required',
            'not_suitable' => 'required',
            'meeting_point' => 'required',
            'important_information' => 'required',
            'position' => 'required',

        ]);

        // dd($request->all());
        // Handle image upload
        if ($request->hasFile('images')) {
            //$imageURLs = [];

            foreach ($request->file('images') as $imageFile) {

                // dd($imageFile);
                $imageName = $imageFile->getClientOriginalName(); // Get the original image name

                // Move the uploaded image to the storage location
                $imagePath = $imageFile->move('public/city/images', $imageName);

                // Generate the URL for the saved image
                $imageURLs[] = asset('public/city/images/' . $imageName);
            }
        }
        $im=json_encode($imageURLs);
        if ($request->hasFile('front_images')) {
            //$imageURLs = [];

            foreach ($request->file('front_images') as $frontimageFile) {

                // dd($imageFile);
                $frontimageName = $frontimageFile->getClientOriginalName(); // Get the original image name

                // Move the uploaded image to the storage location
                $frontimagePath = $frontimageFile->move('public/city/front_images', $frontimageName);

                // Generate the URL for the saved image
                $frontimageURLs[] = asset('public/city/front_images/' . $frontimageName);
            }
        }
        $ftim=json_encode($frontimageURLs);

        // Insert data into the 'citytours' table using the query builder
        $cityI=Citytour::create([
            'title' => $validatedData['title'],
            'singleLineDetail' => $validatedData['singleLineDetail'],
            'totalDays' => $validatedData['totalDays'],
           'tour_type_section' => $validatedData['tour_type_section'],
            'ageRestriction' => $validatedData['ageRestriction'],
            'oldPrice' => ($request['oldPrice'])? $request['oldPrice']:0,
            'newPrice' => $validatedData['newPrice'],
            'fromDate' => $validatedData['fromDate'],
            // 'promoCode' => $validatedData['promoCode'],
            'howManyPeople' => $validatedData['howManyPeople'],
            'images' => $im, // Store all image URLs
            'front_images' => $ftim, // Store all image URLs
            'longDetail' => $validatedData['longDetail'],
            'highlights' => $validatedData['highlights'],
            'full_decription' => $validatedData['full_decription'],
            'not_suitable' => $validatedData['not_suitable'],
            'meeting_point' => $validatedData['meeting_point'],
            'includes' => $validatedData['includes'],
            'important_information' => $validatedData['important_information'],
            'position' => $validatedData['position'],

        ]);
        // dd($cityI);
        foreach ($request->ava_time as $key => $package) {
            $packageTime = array(
                'package_name'=>"citytour",
                'time' => $request->ava_time[$key],
                'package_id' => $cityI->id // Use $validatedData->id if it's an object
            );
            Time::create($packageTime);
        }

        session()->flash('success', 'City created successfully');
        // Redirect back with a success message or to a different route
        return redirect()->route('city.index');
    }
    public function edit($id)
    {
        if(\Auth::user()->can('citytour edit')) {
            $section=$this->section;
            // $tourPackage=Citytour::with('time')->where('id',$id)->first();
            $re="citytour";
            $tourPackage = Citytour::with(['time' => function ($query) use ($re,$id) {
                $query->where('package_name', $re)
                    ->where('package_id', $id);
            }])->where('id',$id)->first();
            // $time=Time::where('package_id',$id)->get();
            //  dd( $time);
            return view($section->folder.'.edit',compact('section','tourPackage'));
        }else{
            abort(403,'Dont have access');
        }
    }
    public function update(Request $request, $id)
    {
        // Validate the incoming data (excluding image field if it's not required)
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'singleLineDetail' => 'required',
            'totalDays' => 'required',
           'tour_type_section' => 'required',
            'ageRestriction' => 'nullable|numeric',
            'newPrice' => 'required|numeric',
            'fromDate' => 'required|date',
            // 'promoCode' => 'required',
            'howManyPeople' => 'nullable',
            'longDetail' => 'required',
            'highlights' => 'required',
            'full_decription' => 'required',
            'includes' => 'required',
            'not_suitable' => 'required',
            'meeting_point' => 'required',
            'important_information' => 'required',
            'position' => 'required',

            // Add validation rules for other fields as needed
        ]);

        // Handle image upload if new images are provided
        if ($request->hasFile('images')) {
            $imageURLs = [];

            foreach ($request->file('images') as $imageFile) {
                $imageName = $imageFile->getClientOriginalName(); // Get the original image name

                // Move the uploaded image to the storage location
                $imagePath = $imageFile->move('public/city/images', $imageName);

                // Generate the URL for the saved image
                $imageURLs[] = asset('public/city/images/' . $imageName);
            }

            // Update the 'images' column in the 'citytours' table with the new image URLs
            DB::table('citytours')
                ->where('id', $id)
                ->update(['images' => json_encode($imageURLs)]);
        }
//front images
if ($request->hasFile('front_images')) {
    $imageURLs = [];

    foreach ($request->file('front_images') as $frontimageFile) {
        $frontimageName = $frontimageFile->getClientOriginalName(); // Get the original image name

        // Move the uploaded image to the storage location
        $frontimagePath = $frontimageFile->move('public/city/front_images', $frontimageName);

        // Generate the URL for the saved image
        $frontimageURLs[] = asset('public/city/front_images/' . $frontimageName);
    }

    // Update the 'images' column in the 'citytours' table with the new image URLs
    DB::table('citytours')
        ->where('id', $id)
        ->update(['front_images' => json_encode($frontimageURLs)]);
}

        $validatedData['oldPrice']= ($request->oldPrice)? $request->oldPrice:0;

        // Update the tour package record in the database using the query builder
        Citytour::where('id', $id)->update($validatedData);
        Time::where('package_id',$id)->where('package_name','citytour')->delete();

// dd($cityI);
        foreach ($request->ava_time as $key => $package) {
            $packageTime = array(
                'package_name'=>"citytour",
                'time' => $request->ava_time[$key],
                'package_id' => $id // Use $validatedData->id if it's an object
            );
            Time::create($packageTime);
        }

        session()->flash('success', 'City Updated successfully');

        // Redirect back with a success message or to a different route
        return redirect()->route('city.index');
    }
    public function destroy($id)
    {
        // Find the city by its ID
        $tourPackage = Citytour::findOrFail($id);

        // Delete the city
        $tourPackage->delete();
        session()->flash('success', 'City deleted successfully');

        // Redirect back with a success message or to a different route
        return redirect()->route('city.index');
    }
    public function show($id)
    {
        if(\Auth::user()->can('citytour show')) {
            $section=$this->section;
            $re="citytour";
            $tourPackage = Citytour::with(['time' => function ($query) use ($re,$id) {
                $query->where('package_name', $re)
                    ->where('package_id', $id);
            }])->where('id',$id)->first();
//dd($users);

            // $tourPackage=Citytour::with('time')->where('id',$id)->first();
            // $time=Time::where('package_id',$id)->get();
            // dd( $tourPackage);
            return view($section->folder.'.show',compact('section','tourPackage'));
        }else{
            abort(403,'Dont have access');
        }
    }

    public function booking()
    {
        $section=$this->section;
        $booking = Booking::with('booking_item')->where('activity_type', "cityTour")->get();
        return view($section->folder.'.booking',compact('section','booking'));

    }
    public function showbooking($id)
    {
        $section=$this->section;
        $booking = Booking::with('cityTour','Time')
        ->where('id', $id)
        ->where('activity_type', "cityTour")
        ->first();
            // dd($booking);

        // $booking = Booking::with('cityTour')->where('id', $id)->where('activity_type', "cityTour")->first();
        // dd($booking);

        return view($section->folder.'.showbooking',compact('section','booking'));
    }




    public function deleteImage($id, $index)
    {
        $tourPackage = Citytour::findOrFail($id);

        $images = json_decode($tourPackage->images, true);

        if (isset($images[$index])) {

            array_splice($images, $index, 1);
            $tourPackage->update(['images' => json_encode($images)]);

            session()->flash('success', 'Image deleted successfully');
        } else {

            session()->flash('error', 'Image not found for deletion');
        }

        return redirect()->back()->with(['success'=>'Deleted successfully']);

    }

    public function featured($type,$id){

        $activityType = $type;
        $activityId = $id;
        if ($activityType == 'citytour') {
            Citytour::where('id', $activityId)->update(['featured' => 1]);
        } elseif ($activityType == 'attraction') {
            Attraction::where('id', $activityId)->update(['featured' => 1]);
        } elseif ($activityType == 'adventure') {
            Adventure::where('id', $activityId)->update(['featured' => 1]);
        } elseif ($activityType == 'vip') {
            Viptransportation::where('id', $activityId)->update(['featured' => 1]);
        }
        elseif ($activityType == 'transportation') {
            Transportation::where('id', $activityId)->update(['featured' => 1]);
        }
        return redirect()->back()->with('success',"Successfully Featured!");

    }
    public function unfeatured($type,$id){

        $activityType = $type;
        $activityId = $id;
        if ($activityType == 'citytour') {
            Citytour::where('id', $activityId)->update(['featured' => 0]);
        } elseif ($activityType == 'attraction') {
            Attraction::where('id', $activityId)->update(['featured' => 0]);
        } elseif ($activityType == 'adventure') {
            Adventure::where('id', $activityId)->update(['featured' => 0]);
        } elseif ($activityType == 'vip') {
            Viptransportation::where('id', $activityId)->update(['featured' =>0]);
        }elseif ($activityType == 'transportation') {
            Transportation::where('id', $activityId)->update(['featured' =>0]);
        }
        return redirect()->back()->with('success',"Successfully UnFeatured!");

    }


}
