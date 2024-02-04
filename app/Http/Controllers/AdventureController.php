<?php

namespace App\Http\Controllers;
use App\Models\Adventure;
use App\Models\Booking;
use App\Models\Time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AdventureController extends Controller
{
    public function __construct(){
        $this->section = new \stdClass();
        $this->section->title = 'Adventure';
        $this->section->heading = 'Adventure';
        $this->section->slug = 'Adventure';
        $this->section->folder = 'adventure';
    }
    public function index()
    {
        $section=$this->section;
        $adventure=Adventure::all();
        return view($section->folder.'.index',compact('section','adventure'));
        // return response()->json(['data' => $tourPackages]);
    }
    public function create()
    {
        $section=$this->section;
        $adventure=Adventure::get();
        return view($section->folder.'.form',compact('section','adventure'));
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

            'images.*' => 'image',
            'front_images.*' => 'image', // Adjust image validation rules as needed // Adjust image validation rules as needed
             // Adjust image validation rules as needed
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
                $imagePath = $imageFile->move('public/adventure/images', $imageName);

                // Generate the URL for the saved image
                $imageURLs[] = asset('public/adventure/images/' . $imageName);
            }
            //  dd($imageURLs);
            // Do not overwrite the "images" key in $validatedData
        }
        $im=json_encode($imageURLs);



        if ($request->hasFile('front_images')) {
            //$imageURLs = [];

            foreach ($request->file('front_images') as $frontimageFile) {

                // dd($imageFile);
                $frontimageName = $frontimageFile->getClientOriginalName(); // Get the original image name

                // Move the uploaded image to the storage location
                $frontimagePath = $frontimageFile->move('public/adventure/front_images', $frontimageName);

                // Generate the URL for the saved image
                $frontimageURLs[] = asset('public/adventure/front_images/' . $frontimageName);
            }
        }
        $ftim=json_encode($frontimageURLs);

        // Insert data into the 'citytours' table using the query builder
        $adventureI=Adventure::create([
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

        foreach ($request->ava_time as $key => $package) {
            $packageTime = array(
                'package_name'=>"adventure",
                'time' => $request->ava_time[$key],
                'package_id' => $adventureI->id // Use $validatedData->id if it's an object
            );
            Time::create($packageTime);
        }

        session()->flash('success', 'Adventure created successfully');
        // Redirect back with a success message or to a different route
        return redirect()->route('adventure.index');
    }

    public function edit($id)
    {
        $section=$this->section;
        //$adventure=Adventure::with('time')->where('id',$id)->first();
        // $time=Time::where('package_id',$id)->get();
        // dd( $tourPackage);
        $re="adventure";
        $adventure = Adventure::with(['time' => function ($query) use ($re,$id) {
            $query->where('package_name', $re)
                ->where('package_id', $id);
        }])->where('id',$id)->first();
// dd($users);


        return view($section->folder.'.edit',compact('section','adventure'));
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
                $imagePath = $imageFile->move('public/adventure/images', $imageName);

                // Generate the URL for the saved image
                $imageURLs[] = asset('public/adventure/images/' . $imageName);
            }

            // Update the 'images' column in the 'citytours' table with the new image URLs
            DB::table('adventures')
                ->where('id', $id)
                ->update(['images' => json_encode($imageURLs)]);
        }




//front images
if ($request->hasFile('front_images')) {
    $imageURLs = [];

    foreach ($request->file('front_images') as $frontimageFile) {
        $frontimageName = $frontimageFile->getClientOriginalName(); // Get the original image name

        // Move the uploaded image to the storage location
        $frontimagePath = $frontimageFile->move('public/adventure/front_images', $frontimageName);

        // Generate the URL for the saved image
        $frontimageURLs[] = asset('public/adventure/front_images/' . $frontimageName);
    }

    // Update the 'images' column in the 'citytours' table with the new image URLs
    DB::table('adventures')
        ->where('id', $id)
        ->update(['front_images' => json_encode($frontimageURLs)]);
}


        $validatedData['oldPrice']= ($request->oldPrice)? $request->oldPrice:0;

        // Update the tour package record in the database using the query builder
        DB::table('adventures')
            ->where('id', $id)
            ->update($validatedData);

        Time::where('package_id',$id)->where('package_name','adventure')->delete();
        foreach ($request->ava_time as $key => $package) {
            $packageTime = array(
                'package_name'=>"adventure",
                'time' => $request->ava_time[$key],
                'package_id' => $id // Use $validatedData->id if it's an object
            );
            Time::create($packageTime);
        }

        session()->flash('success', 'Adventure Updated successfully');

        // Redirect back with a success message or to a different route
        return redirect()->route('adventure.index');
    }

    public function destroy($id)
    {
        $Attraction = Adventure::findOrFail($id);
        $Attraction->delete();
        session()->flash('success', 'Adventure deleted successfully');
        return redirect()->route('adventure.index');
    }

    public function show($id)
    {
        $section=$this->section;
        $re="adventure";
        $adventure = Adventure::with(['time' => function ($query) use ($re,$id) {
            $query->where('package_name', $re)
                ->where('package_id', $id);
        }])->where('id',$id)->first();
        // $adventure=Adventure::with('time')->where('id',$id)->first();
        // $time=Time::where('package_id',$id)->get();
        // dd( $tourPackage);
        return view($section->folder.'.show',compact('section','adventure'));
    }

    public function booking()
    {
        $section=$this->section;
        $booking = Booking::where('activity_type', "Adventure")->get();
        return view($section->folder.'.booking',compact('section','booking'));

    }
    public function showbooking($id)
    {
        $section=$this->section;
        $booking = Booking::with('adventure','Time')
        ->where('id', $id)
        ->where('activity_type', "Adventure")
        ->first();
     // dd($booking);
        // $booking = Booking::with('adventure')->where('id', $id)->where('activity_type', "Adventure")->first();

        return view($section->folder.'.showbooking',compact('section','booking'));
    }



    public function deleteImage($id, $index)
    {
        $adventure = Adventure::findOrFail($id);

        $images = json_decode($adventure->images, true);

        if (isset($images[$index])) {

            array_splice($images, $index, 1);
            $adventure->update(['images' => json_encode($images)]);

            session()->flash('success', 'Image deleted successfully');
        } else {

            session()->flash('error', 'Image not found for deletion');
        }

        return redirect()->back()->with(['success'=>'Image Deleted successfully']);

    }


}
