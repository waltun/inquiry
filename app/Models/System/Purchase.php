<?php

namespace App\Models\System;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'important', 'document_number', 'date', 'title', 'request_quantity', 'status', 'accepted_quantity', 'unit',
        'buy_location', 'description', 'coding_id', 'applicant'
    ];

    public function coding()
    {
        return $this->belongsTo(Coding::class);
    }
}
