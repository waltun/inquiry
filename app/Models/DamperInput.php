<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DamperInput extends Model
{
    use HasFactory;

    protected $fillable = [
        'debi_hava_taze', 'sorat_hava', 'tedad_pare', 'diomantion', 'type', 'inquiry_id', 'part_id'
    ];
}
