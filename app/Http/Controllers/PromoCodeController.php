<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PromoCode;


class PromoCodeController extends Controller
{
    public function __construct(){
        $this->section = new \stdClass();
        $this->section->title = 'Promo Code';
        $this->section->heading = 'Promo Code';
        $this->section->slug = 'promocode';
        $this->section->folder = 'promocode';
    }
    public function index()
    {
        if(\Auth::user()->can('promocode list')) {
            $section = $this->section;
            $promocode = PromoCode::all();
            return view($section->folder . '.index', compact('section', 'promocode'));
        }else{
            abort(403,'Dont have access');
        }
    }


    public function create()
    {
        if(\Auth::user()->can('promocode create')) {
            $section=$this->section;
            $promocode=PromoCode::get();
            return view($section->folder.'.form',compact('section','promocode'));
        }else{
            abort(403,'Dont have access');
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'coupon_code' => 'required|max:255',
            'discount' => 'required',
           

        ]);
       
        $promocode=PromoCode::create([
            'coupon_code' => $validatedData['coupon_code'],
            'discount' => $validatedData['discount'],
            

        ]);
        session()->flash('success', 'Promo Code created successfully');
        return redirect()->route('promo.index');
    }



    public function edit($id)
    {
        $section=$this->section;
        $promocode=PromoCode::where('id',$id)->first();
        return view($section->folder.'.edit',compact('section','promocode'));
    }
    public function update(Request $request, $id)
{
    $promocode = $request->validate([
        'coupon_code' => 'required',
        'discount' => 'required',

    ]);
   
   
    PromoCode::where('id', $id)->update($promocode);

    session()->flash('success', ' Updated successfully');
    return redirect()->route('promo.index');
}

public function show($id)
{
    $section=$this->section;
    $promocode=PromoCode::where('id',$id)->first();
    return view($section->folder.'.show',compact('section','promocode'));
}
public function destroy($id)
{
    
    $promocode = PromoCode::findOrFail($id);

    
    $promocode->delete();
    session()->flash('success', 'Deleted successfully');
    return redirect()->route('promo.index');
}

}
