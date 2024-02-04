<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->section = new \stdClass();
        $this->section->title = 'Pages';
        $this->section->heading = 'Pages';
        $this->section->slug = 'page';
        $this->section->folder = 'pages';
    }
    public function index()
    {
        $section=$this->section;
        $pages=Page::all();
        return view($section->folder.'.index',compact('section','pages'));
        // return response()->json(['data' => $tourPackages]);
    }
    public function create()
    {
        $section=$this->section;
        return view($section->folder.'.form',compact('section'));
    }
    public function store(Request $request)
    {
       // dd($request->all());
        $validatedData = $request->validate([
            'page_heading' => 'required|max:255',
            'slug' => 'required|unique:pages,slug',
            'contentD' => 'required',
            'title' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust image validation rules as needed // Adjust image validation rules as needed

        ]);


        $image = $request->file('image'); // Assuming 'image' is the name of the file input in your form
        if ($image) {
            $imageName = $image->getClientOriginalName(); // Get the original image name
            $image->move('public/page/images', $imageName); // Move the uploaded file to the desired directory
            $imageURL = asset('public/page/images/' . $imageName); // Generate the URL to the stored image
        }
        $data=[
            'slug'=>str_replace(' ', '_',$request->slug),
            'content'=>$request->contentD,
            'header_hero_image'=>$imageURL,
            'title'=>$request->title,
            'page_heading'=>$request->page_heading,
        ];
        //dd($data);
       Page::create($data);

        session()->flash('success', 'Page created successfully');
        // Redirect back with a success message or to a different route
        return redirect()->route('page.index');
    }
    public function edit($id)
    {
        $section=$this->section;
        $page = Page::where('id',$id)->first();
        return view($section->folder.'.edit',compact('section','page'));
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'page_heading' => 'required|max:255',
            'slug' => 'required',
            'contentD' => 'required',
            'title' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust image validation rules as needed // Adjust image validation rules as needed

        ]);

        $data=[
            'slug'=>str_replace(' ', '_',$request->slug),
            'content'=>$request->contentD,
            'title'=>$request->title,
            'page_heading'=>$request->page_heading,
        ];
        $image = $request->file('image'); // Assuming 'image' is the name of the file input in your form
        if ($image) {
            $imageName = $image->getClientOriginalName(); // Get the original image name
            $image->move('public/page/images', $imageName); // Move the uploaded file to the desired directory
            $imageURL = asset('public/page/images/' . $imageName); // Generate the URL to the stored image
           $data['header_hero_image']=$imageURL;

        }

        //dd($data);
        Page::where('id',$id)->update($data);

        session()->flash('success', 'Page Updated successfully');
        // Redirect back with a success message or to a different route
        return redirect()->route('page.index');

        session()->flash('success', 'page  Updated successfully');

        // Redirect back with a success message or to a different route
        return redirect()->route('adventure.index');
    }
    public function destroy($id)
    {
        // Find the city by its ID
        $page = Page::findOrFail($id);

        // Delete the city
        $page->delete();
        session()->flash('success', 'Page deleted successfully');

        // Redirect back with a success message or to a different route
        return redirect()->route('page.index');
    }

}
