<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'code'
    ];

    public function modells()
    {
        return $this->hasMany(Modell::class);
    }

    public function parts()
    {
        return $this->belongsToMany(Part::class)->withPivot('value');
    }

    public function checklists()
    {
        return $this->belongsToMany(Checklist::class)->withPivot(['completed', 'completed_at', 'sort']);
    }
}
