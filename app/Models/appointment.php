<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class appointment extends Model
{
    use HasFactory;

    protected $guarded = [ ];


    public function doctor()
    {

        return $this->belongsTo(Doctor::class);
    }
    public function setTransactionDateAttribute($value)
{
    $this->attributes['appointment_date'] = Carbon::createFromFormat('Y/m/d', $value)->format('Y-m-d');
}
public function getAppointmentTimeAttribute($value)
{
    return Carbon::parse($value)->format("H:i");
}
 

}
