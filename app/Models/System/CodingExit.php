<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodingExit extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'quantity', 'unit', 'description', 'getter_name', 'car_number', 'phone', 'return_date', 'coding_id'
    ];

    public function coding()
    {
        return $this->belongsTo(Coding::class);
    }
}
