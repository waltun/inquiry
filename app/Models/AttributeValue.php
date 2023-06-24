<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'attribute_id', 'value'
    ];

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function parts()
    {
        return $this->belongsToMany(Part::class);
    }
}
