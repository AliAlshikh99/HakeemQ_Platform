<?php

namespace App\Http\Controllers;

use App\Models\time;
use Illuminate\Http\Request;

class TimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\time  $time
     * @return \Illuminate\Http\Response
     */
    public function show($day)
    {
   
         $times=time::where('day',$day)->firstOrFail();
        $available_times=$times->times;
        return $available_times;
      
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\time  $time
     * @return \Illuminate\Http\Response
     */
    public function edit(time $time)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\time  $time
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, time $time)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\time  $time
     * @return \Illuminate\Http\Response
     */
    public function destroy(time $time)
    {
        //
    }

   
}
