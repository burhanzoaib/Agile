<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Files;
use App\Models\Role;


class DefaulterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->section = new \stdClass();
        $this->section->slug = 'file';
        $this->section->folder = 'file';
    }
    public function index()
    {
        $file = Files::with('role')->get();
        return view('file.defaulter',compact('file'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $section = $this->section;
        $section->method = 'POST';
        $section->route = $section->slug.'.store';
        $role=Role::get();
        return view('file.form',compact('section','role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $section = $this->section;
        $qwe = $request->filezip->getClientOriginalName();
        $request->filezip->move(public_path('public/images'), $qwe);
        $request->request->add(['file'=>$qwe]);
        Files::create($request->all());
        $request->session()->flash('flash_message', 'Record has been added successfully.');
        return redirect()->route($section->slug.'.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $section = $this->section;
        $section->method = 'PUT';
        $file = Files::where('id',$id)->first();
        $role=Role::get();
        return view($section->folder.'.edit', compact('file', 'section','role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $section = $this->section;
        $file = Files::find($id);
        if($request->hasFile('filezip')){
            $qwe = $request->filezip->getClientOriginalName();
            $request->filezip->move(public_path('public/images'), $qwe);
            $request->request->add(['file'=>$qwe]);
            $file->update($request->all());
        }else{
            $file->update($request->all());
        }
        return redirect()->route($section->slug.'.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
