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

    public function systemCategories()
    {
        return $this->belongsToMany(SystemCategory::class, 'coding_system_category', 'coding_id', 'category_id');
    }

    public function stores()
    {
        return $this->hasMany(Store::class);
    }
}
