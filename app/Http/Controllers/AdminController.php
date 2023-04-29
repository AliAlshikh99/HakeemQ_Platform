<?php

namespace App\Http\Controllers;

use App\Models\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
     public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5',

        ]);
        $check_creds=Auth::guard('admin')->attempt($request->only(['email', 'password']));


        if ($check_creds) {

               $admin = admin::where('email', $request->email)->first();
            $token = $admin->createToken('admin token',['admin'])->plainTextToken;
            return response()->json([
                'message' => 'admin logged in successfully',
                'admin' => $admin->name,
                'token' => $token,
            ]);
        } else {
            return response()->json([
                'message' => 'Email or Password not correct',
            ]);
            
        }
    }
}

