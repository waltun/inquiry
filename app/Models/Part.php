<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'unit', 'price', 'code', 'collection', 'category_id'
    ];

    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function parents()
    {
        return $this->belongsToMany(Part::class, 'part_child', 'parent_part_id', 'child_part_id');
    }

    public function children()
    {
        return $this->belongsToMany(Part::class, 'part_child', 'child_part_id', 'parent_part_id');
    }
}
