<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'manager', 'group_id', 'model_id', 'submit', 'inquiry_number', 'price', 'percent', 'archive_at',
        'user_id'
    ];

    public function amounts()
    {
        return $this->hasMany(Amount::class);
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_model_inquiry', 'inquiry_id', 'group_id');
    }

    public function modells()
    {
        return $this->belongsToMany(Modell::class, 'group_model_inquiry', 'inquiry_id', 'model_id');
    }
}
