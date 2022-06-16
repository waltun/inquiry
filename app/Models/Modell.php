<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modell extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'group_id', 'code'
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function inquiries()
    {
        return $this->belongsToMany(Inquiry::class, 'group_model_inquiry', 'model_id', 'inquiry_id');
    }
}
