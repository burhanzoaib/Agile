<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Viptransportation;
use App\Models\Time;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;


class VipTransportationController extends Controller
{
    public function __construct(){
        $this->section = new \stdClass();
        $this->section->title = 'Luxury Experiences';
        $this->section->heading = 'Luxury Experiences';
        $this->section->slug = 'Vip Transportation';
        $this->section->folder = 'viptransportation';
    }
    public function index()
    {
        if(\Auth::user()->can('viptransportation list')) {
            $section = $this->section;
            $viptransportation = Viptransportation::all();
            return view($section->folder . '.index', compact('section', 'viptransportation'));

        }else{
            abort(403,'Dont have access');
        }
    }
    public function create()
    {
        if(\Auth::user()->can('viptransportation create')) {
            $section=$this->section;
            $viptransportation=Viptransportation::get();
            return view($section->folder.'.form',compact('section','viptransportation'));
        }else{
            abort(403,'Dont have access');
        }
    }

    public function store(Request $request)
    {
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
                $imagePath = $imageFile->move('public/viptransportation/images', $imageName);
                $imageURLs[] = asset('public/viptransportation/images/' . $imageName);
            }
        }
        $im=json_encode($imageURLs);
        if ($request->hasFile('front_images')) {
            foreach ($request->file('front_images') as $frontimageFile) {
                $frontimageName = $frontimageFile->getClientOriginalName();
                $frontimagePath = $frontimageFile->move('public/viptransportation/front_images', $frontimageName);
                $frontimageURLs[] = asset('public/viptransportation/front_images/' . $frontimageName);
            }
        }
        $ftim=json_encode($frontimageURLs);
        $viptransportationI=Viptransportation::create([
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
                'package_name'=>"viptransportation",
                'time' => $request->ava_time[$key],
                'package_id' => $viptransportationI->id
            );
            Time::create($packageTime);
        }

        session()->flash('success', 'Luxury Experiences created successfully');
        return redirect()->route('vip.index');
    }



    public function edit($id)
    {
        if(\Auth::user()->can('viptransportation edit')) {
            $section=$this->section;
            $re="citytour";
            $viptransportation = Viptransportation::with(['time' => function ($query) use ($re,$id) {
                $query->where('package_name', $re)
                    ->where('package_id', $id);
            }])->where('id',$id)->first();
            return view($section->folder.'.edit',compact('section','viptransportation'));
        }else{
            abort(403,'Dont have access');
        }
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
        ]);
        // dd($validatedData);
        if ($request->hasFile('images')) {
            $imageURLs = [];

            foreach ($request->file('images') as $imageFile) {
                $imageName = $imageFile->getClientOriginalName();
                $imagePath = $imageFile->move('public/viptransportation/images', $imageName);
                $imageURLs[] = asset('public/viptransportation/images/' . $imageName);
            }
            DB::table('viptransportations')
                ->where('id', $id)
                ->update(['images' => json_encode($imageURLs)]);
        }
    if ($request->hasFile('front_images')) {
    $imageURLs = [];

    foreach ($request->file('front_images') as $frontimageFile) {
        $frontimageName = $frontimageFile->getClientOriginalName();
        $frontimagePath = $frontimageFile->move('public/viptransportation/front_images', $frontimageName);
        $frontimageURLs[] = asset('public/viptransportation/front_images/' . $frontimageName);
    }

    DB::table('viptransportations')
        ->where('id', $id)
        ->update(['front_images' => json_encode($frontimageURLs)]);
}
        $validatedData['oldPrice']= ($request->oldPrice)? $request->oldPrice:0;

        Viptransportation::where('id', $id)->update($validatedData);
        Time::where('package_id',$id)->where('package_name','viptransportation')->delete();
        foreach ($request->ava_time as $key => $package) {
            $packageTime = array(
                'package_name'=>"viptransportation",
                'time' => $request->ava_time[$key],
                'package_id' => $id
            );
            Time::create($packageTime);
        }

        session()->flash('success', 'Luxury Experiences Updated successfully');
        return redirect()->route('vip.index');
    }

    public function show($id)
    {
        if(\Auth::user()->can('viptransportation show')) {
            $section=$this->section;
            $re="viptransportation";
            $viptransportation = Viptransportation::with(['time' => function ($query) use ($re,$id) {
                $query->where('package_name', $re)
                    ->where('package_id', $id);
            }])->where('id',$id)->first();

            return view($section->folder.'.show',compact('section','viptransportation'));
        }else{
            abort(403,'Dont have access');
        }
    }

    public function destroy($id)
    {
        $viptransportation = Viptransportation::findOrFail($id);
        $viptransportation->delete();
        session()->flash('success', 'Luxury Experiences deleted successfully');
        return redirect()->route('vip.index');
    }

    public function booking()
    {
        $section=$this->section;
        $booking = Booking::where('activity_type', "Viptransportation")->get();
        return view($section->folder.'.booking',compact('section','booking'));
    }

    public function showbooking($id)
    {
        $section=$this->section;
        $booking = Booking::with('Viptransportation','Time')
        ->where('id', $id)
        ->where('activity_type', "Viptransportation")
        ->first();
// dd($booking);

        return view($section->folder.'.showbooking',compact('section','booking'));
    }


    public function deleteImage($id, $index)
    {
        $viptransportation = Viptransportation::findOrFail($id);

        $images = json_decode($viptransportation->images, true);

        if (isset($images[$index])) {

            array_splice($images, $index, 1);
            $viptransportation->update(['images' => json_encode($images)]);

            session()->flash('success', 'Image deleted successfully');
        } else {

            session()->flash('error', 'Image not found for deletion');
        }

        return redirect()->back()->with(['success'=>'Image Deleted successfully']);

    }


}
