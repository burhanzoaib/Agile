<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\OTPEmail;

class AuthController extends Controller
{
    public function register(Request $request)
    {


 // Check if the email already exists
 $existingUser = User::where('email', $request->email)->first();

 if ($existingUser) {
     // If email exists, return validation error
     return response()->json(['error' => 'Email already exists'], 422);
 }

        $user = User::create([
            'name' => $request->name,
            'lname' => $request->lname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = $user->createToken('authToken')->plainTextToken;
        return response()->json(['message' => 'User registered successfully','token' => $token]);
    }

    public function login(Request $request)
    {


        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json(['message' => 'User login successfully','token' => $token,'user'=>$user]);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }




    public function forgotpassword(Request $request)
    {
        $email = $request->email;
        $otp = rand(1000, 9999);
        $user=User::where('email',$email)->first();
        if($user){
            Mail::to($email)->send(new OTPEmail($otp));
            $optp=[
                'otp'=>$otp,
            ];
            User::where('email',$email)->update($optp);
            return response()->json(['otp' => $otp, 'message' => 'Successfully sent']);
        }
            return response()->json(['message' => 'Not a Valid Email']);



    }


    public function Checkotp(Request $request)
    {
        $otp = $request->otp;
        $newPassword = $request->newpassword;
        $email = $request->email;
        $user = User::where('email', $email)->first();

        if ($user && $otp == $user->otp) {
            $user->update([
                'password' => Hash::make($newPassword)
            ]);



            return response()->json(['message' => 'Password updated successfully']);
        } else {
            return response()->json(['message' => 'OTP is incorrect or user not found'], 400);
        }
    }

}
