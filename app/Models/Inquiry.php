<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'manager', 'group_id', 'model_id', 'submit', 'inquiry_number'
    ];

    public function amounts()
    {
        return $this->hasMany(Amount::class);
    }
}
