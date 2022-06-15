<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'unit', 'price', 'code', 'collection'
    ];

    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }
}
