<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coding extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'unit', 'code', 'store', 'copy'
    ];

    public function categories()
    {
        return $this->belongsToMany(SystemCategory::class, 'coding_system_category', 'category_id', 'coding_id');
    }

    public function stores()
    {
        return $this->hasMany(Store::class);
    }
}
