<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'percent', 'price', 'quantity', 'group_id', 'model_id', 'inquiry_id', 'part_id', 'description', 'model_custom_name'
    ];

    public function inquiry()
    {
        return $this->belongsTo(Inquiry::class);
    }

    public function amounts()
    {
        return $this->hasMany(Amount::class);
    }
}
