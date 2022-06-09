<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amount extends Model
{
    use HasFactory;

    protected $fillable = [
        'value', 'part_id', 'inquiry_id'
    ];

    public function inquiry()
    {
        return $this->belongsTo(Inquiry::class);
    }
}
