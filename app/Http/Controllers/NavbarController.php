<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Navbar;


class NavbarController extends Controller
{
    public function __construct(){
        $this->section = new \stdClass();
        $this->section->title = 'Navbar';
        $this->section->heading = 'Navbar';
        $this->section->slug = 'Navbar';
        $this->section->folder = 'navbar';
    }

    public function index()
    {
        $section=$this->section;
        $navbar=Navbar::get();
        return view($section->folder.'.index',compact('section','navbar'));
    }
    public function show()
    {
        $section=$this->section;
        $navbar=Navbar::get();
        return view($section->folder.'.show',compact('section','navbar'));
    }
    public function edit($id)
    {
        $section=$this->section;
        $navbar=Navbar::where('id',$id)->first();
        return view($section->folder.'.edit',compact('section','navbar'));
    }
    public function update(Request $request, $id)
{
    $navbar = $request->validate([
        'name' => 'required',
        'link' => 'required',
    ]);
   

  
    Navbar::where('id', $id)->update($navbar);

    session()->flash('success', ' Updated successfully');
    return redirect()->route('navbar.index');
}


public function destroy($id)
{
    
    $navbar = Navbar::findOrFail($id);

    
    $navbar->delete();
    session()->flash('success', 'Deleted successfully');
    return redirect()->route('navbar.index');
}
}
