<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phonebook extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'email', 'category', 'activity', 'address', 'description', 'mobile1', 'mobile2', 'phone1', 'phone2',
        'postal'
    ];
}
