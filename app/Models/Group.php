<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'image', 'code'
    ];

    public function modells()
    {
        return $this->hasMany(Modell::class);
    }

    public function parts()
    {
        return $this->belongsToMany(Part::class);
    }

    public function inquiries()
    {
        return $this->belongsToMany(Inquiry::class, 'group_model_inquiry', 'group_id', 'inquiry_id')
            ->withPivot('model_id', 'percent', 'price', 'quantity');
    }
}
