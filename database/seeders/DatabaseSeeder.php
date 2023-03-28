<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\Doctor::factory(20)->create();
        // \App\Models\DoctorAvailable::factory(20)->create();


        $this->call([
            DoctorAvailable::class,
          
        ]);


        
    }
}
