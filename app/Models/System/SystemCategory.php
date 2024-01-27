<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'code', 'parent_id'
    ];

    public function children()
    {
        return $this->hasMany(SystemCategory::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(SystemCategory::class, 'parent_id');
    }

    public function codings()
    {
        return $this->belongsToMany(Coding::class, 'coding_system_category', 'coding_id', 'category_id');
    }
}
