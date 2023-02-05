<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeleteButton extends Model
{
    use HasFactory;

    protected $fillable = [
        'parts', 'collection_parts', 'collection_coil', 'users', 'inquiries', 'active', 'categories', 'products'
    ];
}
