<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'quantity', 'unit', 'status', 'qc', 'description', 'user_id', 'coding_id', 'date',
        'code', 'store', 'seller', 'delivery', 'store_code'
    ];

    public function coding()
    {
        return $this->belongsTo(Coding::class);
    }
}
