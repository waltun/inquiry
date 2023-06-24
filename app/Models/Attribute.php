<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'unit'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class)->withPivot(['sort', 'default_value', 'attribute_group_id']);
    }

    public function values()
    {
        return $this->hasMany(AttributeValue::class);
    }
}
