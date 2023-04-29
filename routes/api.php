<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;
use App\Models\appointment;
use App\Models\Doctor;
use App\Models\img;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



//!Protected Routes
Route::middleware(['auth:sanctum','abilities:doctor'])->group(function () {
    Route::get('/dashboard', function () {
        return response([
            'data'=>'Welcome in dashboard',
            'request'=>request()->header(),
        ]);
        
    });
    Route::post('logout',[AuthController::class,'logout']);
    Route::get('/appoints', function () {
        $doctor_id=auth()->id();
           $appointments=appointment::where('doctor_id',$doctor_id)->get();
           return $appointments;
        });
        Route::get('/welcome', function () {
            $doctor=auth()->user();
            return 'Welcome Dr.'.$doctor->name;
        });
    });
    Route::apiResource('doctors', DoctorController::class);
    //!Protected Routes
    Route::middleware(['auth:sanctum','abilities:admin'])->group(function () {
    Route::get('/appointments',[AppointmentController::class,'index']);

});

Route::controller(AuthController::class)->group(function () {
    Route::post('/register','register');
    Route::post('/login','login');   
});
Route::controller(AdminController::class)->prefix('admin')->group(function () {
    Route::post('/login','login');   
});

Route::controller(AppointmentController::class)->group(function(){
    Route::get('/available-times/{id}/{date}',[AppointmentController::class,'getAvilableTimes']);
    Route::delete('appoints/delete',[AppointmentController::class,'deleteAll']);
    Route::post('appoints/create',[AppointmentController::class,'store']);

});
 
Route::get('search', [DoctorController::class,'search']);  //! Search api
Route::post('/img', function (Request $request) {
    
    $request->validate([
            'img'=>'image',
        ]);
        
        if ($request->hasFile('img')) {
    $img=$request->file('img');
    $original_name=$img->getClientOriginalName();
    $img_nm=date('Y-m-d').".".$original_name;
    // $img->store('imgs');
    $img->move(public_path('imgs/logos'),$img_nm);
    $path='imgs/'.$img_nm;
    // $new_img=Image::make(public_path('images/'.$img_nm))->resize(400,400)->response('png',50);
    
    img::create([
        'path'=>$path
       
    ]);

    return response('Image Saved');
        
    }
    else{
        return 'Image not found';
    }
    
    

    
    
});
