<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'nation', 'address', 'postal', 'registration_number',
        'telephone', 'email', 'social_phone', 'phone', 'type', 'user_id'
    ];

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
