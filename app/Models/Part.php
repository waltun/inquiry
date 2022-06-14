<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'unit', 'price', 'code'
    ];

    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    public function collections()
    {
        return $this->belongsToMany(Collection::class);
    }
}
