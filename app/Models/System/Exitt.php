<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exitt extends Model
{
    use HasFactory;

    protected $fillable = [
        'number', 'exit_at', 'type', 'exiter', 'car_number', 'phone', 'mission_location', 'mission_reason', 'mission_users', 'accepted', 'confirm_quantity'
    ];

    public function codingExits()
    {
        return $this->hasMany(CodingExit::class);
    }
}
