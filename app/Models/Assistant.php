<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assistant extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->morphOne(User::class, 'profile');
    }

    public function customer()
    {
        return $this->hasMany(Customer::class);
    }

    protected $fillable = [
        'name',
        'phone',
        'address',
        'city',
    ];
}
