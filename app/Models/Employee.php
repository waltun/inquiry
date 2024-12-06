<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'nation', 'level', 'insurance', 'phone', 'cart', 'education', 'start_date', 'end_date', 'address'
    ];
}
