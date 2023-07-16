<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modell extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'group_id', 'code', 'parent_id', 'percent', 'standard'
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function parts()
    {
        return $this->belongsToMany(Part::class)->withPivot(['value', 'sort', 'value2']);
    }

    public function children()
    {
        return $this->hasMany(Modell::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Modell::class, 'parent_id');
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class)->withPivot(['sort', 'default_value', 'attribute_group_id']);
    }

    public function attributeValues()
    {
        return $this->belongsToMany(AttributeValue::class);
    }
}
