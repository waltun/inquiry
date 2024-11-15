<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodingExit extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'quantity', 'unit', 'return_quantity', 'return_date', 'description', 'coding_id', 'exitt_id', 'first_description'
    ];

    public function exitt()
    {
        return $this->belongsTo(Exitt::class);
    }
}
