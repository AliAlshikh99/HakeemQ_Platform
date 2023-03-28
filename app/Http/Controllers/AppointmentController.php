<?php

namespace App\Http\Controllers;

use App\Models\appointment;
use App\Models\Doctor;
use App\Models\DoctorAvailable;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $appointments=appointment::all();
        return $appointments;
      
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'appointment_time'=>'unique:appointments',

        // ]);
       

        $appointment=appointment::create([

           'name'=>$request->name,
           'email'=>$request->email,
           'phone'=>$request->phone,
           'age'=>$request->age,
           'gender'=>$request->gender,
           'description'=>$request->description,
           'appointment_date'=>$request->appointment_date,
           'appointment_time'=>$request->appointment_time,
           'doctor_id'=>$request->doctor_id,
          
        ]);

        return response([
            'status'=>'booking done',
            'appointment'=>$appointment,

        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $appointments=appointment::findOrFail($id);
        return $appointments->doctor->name;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
     
    }
    public function deleteAll()
    {
      DB::table('appointments')->truncate();
      return response('Done Delete ALl');
    }

    public function getAvilableTimes($date)
    {
          $appointment=appointment::where('appointment_date',$date)->get();
    $taken_time=$appointment->pluck('appointment_time')->toArray();
    $day=Carbon::parse($date)->format('l');
    $available=DoctorAvailable::where('day',$day)->first();
    $available_times=[];
    $st_time=strtotime($available->st_time);
    $en_time=strtotime($available->en_time);
    while ($st_time<=$en_time) {
        $time=date('H:i:s',$st_time);
        if(!in_array($time,$taken_time)){

            $available_times[]=$time;
        }
        $st_time+=60*60;
      
    }
    
   return response()->json([
    'available_times'=>$available_times,
    'taken_times'=>$taken_time,
   ]);

    }
}
