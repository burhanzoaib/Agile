<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Group;
use App\Models\Transfer;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;


class CustomerController extends Controller
{
    public function __construct(){
        $this->section = new \stdClass();
        $this->section->title = 'All Customer';
        $this->section->heading = 'Crud';
        $this->section->slug = 'customer';
        $this->section->folder = 'customer';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       
        if(\Auth::user()->can('user list')){
            $customer = User::where('user_type','customer')->get();
            return view('customer.customer',compact('customer'));
        }else{
            abort('405');
          
        }
    }

    public function user()
    {       
        if(\Auth::user()->can('user list')){
            $customer = User::where('user_type','sales')->get();
            return view('customer.customer',compact('customer'));
        }else{
            abort('405');
          
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(\Auth::user()->can('user create')){
            $customer=[];
            $section = $this->section;
            $section->method = 'POST';
            $rolesq = Role::get();

            $section->route = $section->slug.'.store';
            return view($section->folder.'.form',compact('section', 'customer','rolesq'));
        }else{

            abort('405');
          
        }
        
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
		
			$validator        = \Validator::make(
                $request->all(), [
                                   'name' => 'required',
                                   'email' => 'required|unique:users',
                                   'user_type' => 'required',
                                   'password' => 'required',
                               ]
            );
		if($validator->fails())
		{
			$messages = $validator->getMessageBag();
			$request->session()->flash('flash_message', $messages->first());

			return redirect()->back();
		}else{
			$request->request->add(['password'=>Hash::make($request->password),]);
            // if($request->user_type == 1){
            //     $user='customer';
            // }else{
            //     $user='sales';
            // }
            
			$userer=User::create($request->all());
            $userer->syncRoles($request->user_type);

			$request->session()->flash('flash_message', 'Record has been added successfully.');
			return redirect()->route($section->slug.'.index');
		}
		
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(\Auth::user()->user_type == 0){
            $section = $this->section;
            $customer = customer::where('id',$id)->get();
            return view($section->folder.'.detail', compact('customer', 'section'));
        }else{

            return redirect()->route('digitizing.index');
        
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(\Auth::user()->can('user edit')){
            $section = $this->section;
            $section->method = 'PUT';
            $customer = User::where('id',$id)->first();
            $rolesq = Role::get();
            //dd($roles);
            return view($section->folder.'.edit', compact('customer', 'section','rolesq'));
        }else{

           abort('405');
        
        }
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
        $file = User::find($id);
        // if($request->user_type == 1){
        //     $user='customer';
        // }else{
        //     $user='sales';
        // }
        if($request->user_type != null){
			$file->syncRoles($request->user_type);
		}

        $file->update($request->all());
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
