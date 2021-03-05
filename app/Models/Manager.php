<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->morphOne(User::class, 'profile');
    }

    public function assistant()
    {
        return $this->hasMany(Assistant::class, 'manager_id');
    }

    protected $fillable = [
        'name',
        'department'
    ];
}
