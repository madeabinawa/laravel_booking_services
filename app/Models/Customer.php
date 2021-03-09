<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['assistant'];

    public function user()
    {
        return $this->morphOne(User::class, 'profile');
    }

    public function assistant()
    {
        return $this->belongsTo(Assistant::class, 'assistant_id');
    }

    protected $fillable = [
        'name',
        'phone',
        'address',
        'city',
        'priority',
        'assistant_id',
    ];
}
