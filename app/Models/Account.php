<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank', 'account_number', 'card_number', 'shaba_number', 'branch', 'branch_code', 'address'
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function guarantees()
    {
        return $this->hasMany(Guarantee::class);
    }

    public function marketings()
    {
        return $this->hasMany(Marketing::class);
    }
}
