<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'appointment_date',
        'customer_id',
        'assistant_id',
        'rate',
        'status'
    ];

    // Accessor Appointment Date to GET DATE FROM DATABASE
    public function getAppointmentDateAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y');
    }

    // Accessor Status to GET DATE FROM DATABASE
    // public function getStatusAttribute($value)
    // {
    //     return ucfirst(trans($value));
    // }


    // Mutator Appointment Date to SET DATE TO DATABASE
    public function setAppointmentDateAttribute($value)
    {
        $this->attributes['appointment_date'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    // Mutator Status to SET DATE TO DATABASE
    // public function setStatusAttribute($value)
    // {
    //     $this->attributes['status'] = strtoupper($value);
    // }
}
