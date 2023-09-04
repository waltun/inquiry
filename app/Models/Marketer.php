<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marketer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'phone', 'nation',
    ];

    public function marketings()
    {
        return $this->hasMany(Marketing::class);
    }

    public function accounts()
    {
        return $this->hasMany(MarketerAccount::class);
    }
}
