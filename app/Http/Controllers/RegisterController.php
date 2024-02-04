<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;

use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{



    public function user_store(Request $request)
    {


        $existingUser = User::where('email', $request->email)->first();
        if ($existingUser) {
            return response()->json(['error' => 'Email already exists'], 422);
        }
        $user = User::create([
            'name' => $request->name,
            'lname' => $request->lname,
            'email' => $request->email,
            'user_type' => 1,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->back()->with(['success'=>'User Create Successfully!']);
    }

    public function user_update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        $user->name = $request->name;
        $user->lname = $request->lname;
        $user->email = $request->email;
        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect()->back()->with(['success' => 'User updated successfully!']);
    }





    public function index(){



        $user=User::where('user_type',1)->get();
        //$user->assignRole('admin');
        return view('user.index',compact('user'));
    }
    public function form_create(){
        return view('user.form');
    }
    public function edit($id){

         $user=User::where('id',$id)->first();
        return view('user.show',compact('user'));
    }


    public function destroy($id)
    {

        $user = User::findOrFail($id);


        $user->delete();
        session()->flash('success', 'Deleted successfully');
        return redirect()->route('user.index');
    }



}
