<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'code', 'unit', 'price'
    ];

    public function parts()
    {
        return $this->belongsToMany(Part::class);
    }
}
