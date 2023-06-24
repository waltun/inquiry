<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'code', 'parent_id'
    ];

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function parts()
    {
        return $this->belongsToMany(Part::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class)->withPivot(['sort', 'default_value', 'attribute_group_id']);
    }
}
