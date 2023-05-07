<?php

namespace App\Http\Controllers;

use App\Mail\DoctorMail;
use App\Traits\ApiResponse;
use App\Traits\UploadImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\appointment;
use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    
    //! *************Register section***********************
    use ApiResponse;
    
    public function register(RegisterRequest $req)
    {
    
        $doctor = Doctor::create([
            'name' =>$req->name,
            'email' => $req->email,
            'password' => Hash::make($req->password),
            'phone' => $req->phone,
            'gender' => $req->gender,
            'spz'=>$req->spz,
        ]);
        $token = $doctor->createToken('my_token')->plainTextToken;
        
        return  $this->authresponse($doctor,'Welcome Doctor,please check your email',Response::HTTP_CREATED,$token);


    }

    //! *************login section***********************
    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5',

        ]);
        $check_creds=Auth::guard('doctor')->attempt($request->only(['email', 'password']));


        if ($check_creds) {

               $doctor = Doctor::where('email', $request->email)->first();
            $token = $doctor->createToken('login token',['doctor'])->plainTextToken;
            return response()->json([
                'message' => 'doctor logged in successfully',
                'doctor' => $doctor->name,
                'token' => $token,
            ]);
        } else {
            return response()->json([
                'status'=>Response::HTTP_FORBIDDEN,
                'message' => 'Email or Password not correct',
            ]);
            
        }



    }
    //! *************logout section***********************

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();


        return response()->json([
            'message'=>'doctor logged out successfully ',
            
        ]);
    }

    public function upload(Request $request)
    {


        $check=appointment::where('appoint_date',$request->appoint_date)
        ->where('appoint_time',$request->appoint_time)
        ->exists();
        if ($check) {
            return 'Yes exist...';
        }else{
            return 'No exist....';
        
        }
    //    $path=$this->profileimage($request,'profile');
        
    //     DB::table('images')->insert([
    //         'image'=>$path,
            
    //     ]);
        
    //     return response([
    //         'request'=>$request->headers->all(),
    //         'msg'=>'uploading Done',
    //         'path'=>$path,
    //     ]
    //     );
    }


  

}
