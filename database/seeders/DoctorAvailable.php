<?php

namespace Database\Seeders;

use App\Models\DoctorAvailable as ModelsDoctorAvailable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorAvailable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $days=[ "Sunday","Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];

        foreach ($days as  $day) {
            if ($day=='Monday') {
                ModelsDoctorAvailable::create([
                    'day'=>$day,
                    'st_time'=>'9:00:00',
                    'en_time'=>'12:00:00',
                ]);
                
                # code...
            }else{
                ModelsDoctorAvailable::create([
                    'day'=>$day,
                    'st_time'=>'9:00:00',
                    'en_time'=>'16:00:00',
                ]);
                
            }
        

        }
    }
}
