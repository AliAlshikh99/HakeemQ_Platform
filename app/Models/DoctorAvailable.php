<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorAvailable extends Model
{
    use HasFactory;


  public function doctors()
  {
    return $this->belongsToMany(Doctor::class,'doctor_times_pivot');
    
  }
}
