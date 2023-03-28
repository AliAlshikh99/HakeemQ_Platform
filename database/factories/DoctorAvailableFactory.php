<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DoctorAvailable>
 */
class DoctorAvailableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
          $startTime = $this->faker->time('H:i:s');
   
   $endTime = $this->faker->time('H:i:s', strtotime($startTime . ' +1 hour'));
   
   $date = $this->faker->dateTimeBetween('-1 month', '+1 month');
   $doctor_id=$this->faker->randomElement([1,2,3,4,5,6,7,8,9]);   
   return [
       'date' => $date,
       'st_time' => $startTime,
       'en_time' => $endTime,
       'doctor_id'=>$doctor_id,
       
   ];
        
    }
}
