<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marketer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'phone', 'nation', 'user_id'
    ];

    public function marketings()
    {
        return $this->hasMany(Marketing::class);
    }

    public function accounts()
    {
        return $this->hasMany(MarketerAccount::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
