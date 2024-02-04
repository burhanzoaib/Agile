<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Transportation;
use App\Models\Time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransportationController extends Controller
{
    public function __construct(){
        $this->section = new \stdClass();
        $this->section->title = 'Transportation';
        $this->section->heading = 'Transportation';
        $this->section->slug = 'transportation';
        $this->section->folder = 'transportation';
    }
    public function index()
    {
        $section=$this->section;
        $transportation=Transportation::all();
        return view($section->folder.'.index',compact('section','transportation'));  
    }
    public function create()
    {
        $section=$this->section;
        $transportation=Transportation::get();
        return view($section->folder.'.form',compact('section','transportation'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'singleLineDetail' => 'required',
            'totalDays' => 'required',
            'tour_type_section' => 'required',
            'ageRestriction' => 'nullable|numeric',
            'newPrice' => 'required|numeric',
            'oldPrice' => 'nullable|numeric',
            'fromDate' => 'required|date',
            'howManyPeople' => 'nullable',
            'images.*' => 'image',
            'front_images.*' => 'image', 
            'longDetail' => 'required',
            'highlights' => 'required',
            'full_decription' => 'required',
            'includes' => 'required',
            'not_suitable' => 'required',
            'meeting_point' => 'required',
            'important_information' => 'required',
            'position' => 'required',

        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                $imageName = $imageFile->getClientOriginalName(); 
                $imagePath = $imageFile->move('public/transportation/images', $imageName);
                $imageURLs[] = asset('public/transportation/images/' . $imageName);
            }
        }
        $im=json_encode($imageURLs);



        if ($request->hasFile('front_images')) {

            foreach ($request->file('front_images') as $frontimageFile) {
                $frontimageName = $frontimageFile->getClientOriginalName(); 
                $frontimagePath = $frontimageFile->move('public/transportation/front_images', $frontimageName);
                $frontimageURLs[] = asset('public/transportation/front_images/' . $frontimageName);
            }
        }
        $ftim=json_encode($frontimageURLs);
        $transportationI=Transportation::create([
            'title' => $validatedData['title'],
            'singleLineDetail' => $validatedData['singleLineDetail'],
            'totalDays' => $validatedData['totalDays'],
            'tour_type_section' => $validatedData['tour_type_section'],
            'ageRestriction' => $validatedData['ageRestriction'],
            'oldPrice' => ($request['oldPrice'])? $request['oldPrice']:0,
            'newPrice' => $validatedData['newPrice'],
            'fromDate' => $validatedData['fromDate'],
            'howManyPeople' => $validatedData['howManyPeople'],
            'images' => $im, 
            'front_images' => $ftim, 
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
                'package_name'=>"transportation",
                'time' => $request->ava_time[$key],
                'package_id' => $transportationI->id 
            );
            Time::create($packageTime);
        }

        session()->flash('success', 'Transportation created successfully');
       
        return redirect()->route('transportation.index');
    }

    public function edit($id)
    {
        $section=$this->section;
        $re="transportation";
        $transportation = Transportation::with(['time' => function ($query) use ($re,$id) {
            $query->where('package_name', $re)
                ->where('package_id', $id);
        }])->where('id',$id)->first();
        return view($section->folder.'.edit',compact('section','transportation'));
    }

    public function update(Request $request, $id)
    {
        
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'singleLineDetail' => 'required',
            'totalDays' => 'required',
            'tour_type_section' => 'required',
            'ageRestriction' => 'nullable|numeric',
            'newPrice' => 'required|numeric',
            'fromDate' => 'required|date',
            'howManyPeople' => 'nullable',
            'longDetail' => 'required',
            'highlights' => 'required',
            'full_decription' => 'required',
            'includes' => 'required',
            'not_suitable' => 'required',
            'meeting_point' => 'required',
            'important_information' => 'required',
            'position' => 'required',
        ]);
        if ($request->hasFile('images')) {
            $imageURLs = [];

            foreach ($request->file('images') as $imageFile) {
                $imageName = $imageFile->getClientOriginalName(); 
                $imagePath = $imageFile->move('public/transportation/images', $imageName);
                $imageURLs[] = asset('public/transportation/images/' . $imageName);
            }
            DB::table('transportations')
                ->where('id', $id)
                ->update(['images' => json_encode($imageURLs)]);
        }
        if ($request->hasFile('front_images')) {
            $imageURLs = [];

            foreach ($request->file('front_images') as $frontimageFile) {
                $frontimageName = $frontimageFile->getClientOriginalName();
                $frontimagePath = $frontimageFile->move('public/transportation/front_images', $frontimageName);
                $frontimageURLs[] = asset('public/transportation/front_images/' . $frontimageName);
            }
            DB::table('transportations')
                ->where('id', $id)
                ->update(['front_images' => json_encode($frontimageURLs)]);
        }


        $validatedData['oldPrice']= ($request->oldPrice)? $request->oldPrice:0;
        DB::table('transportations')
            ->where('id', $id)
            ->update($validatedData);

        Time::where('package_id',$id)->where('package_name','transportation')->delete();
        foreach ($request->ava_time as $key => $package) {
            $packageTime = array(
                'package_name'=>"transportation",
                'time' => $request->ava_time[$key],
                'package_id' => $id
            );
            Time::create($packageTime);
        }
        session()->flash('success', 'Transportation Updated successfully');
        return redirect()->route('transportation.index');
    }

    public function destroy($id)
    {
        $transportation = Transportation::findOrFail($id);
        $transportation->delete();
        session()->flash('success', 'Transportation deleted successfully');
        return redirect()->route('transportation.index');
    }

    public function show($id)
    {
        $section=$this->section;
        $re="transportation";
        $transportation = Transportation::with(['time' => function ($query) use ($re,$id) {
            $query->where('package_name', $re)
                ->where('package_id', $id);
        }])->where('id',$id)->first();
        return view($section->folder.'.show',compact('section','transportation'));
    }

    public function booking()
    {
        $section=$this->section;
        $booking = Booking::where('activity_type', "Transportation")->get();
        // dd($booking);
        return view($section->folder.'.booking',compact('section','booking'));

    }
    public function showbooking($id)
    {
        $section=$this->section;
        $booking = Booking::with('transportation','Time')
            ->where('id', $id)
            ->where('activity_type', "Transportation")
            ->first();
        return view($section->folder.'.showbooking',compact('section','booking'));
    }



    public function deleteImage($id, $index)
    {
        $transportation = Transportation::findOrFail($id);

        $images = json_decode($transportation->images, true);

        if (isset($images[$index])) {

            array_splice($images, $index, 1);
            $transportation->update(['images' => json_encode($images)]);

            session()->flash('success', 'Image deleted successfully');
        } else {

            session()->flash('error', 'Image not found for deletion');
        }

        return redirect()->back()->with(['success'=>'Image Deleted successfully']);

    }

}
