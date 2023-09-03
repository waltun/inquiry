<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marketer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'phone', 'nation', 'bank_name1', 'account_number1', 'card_number1', 'shaba_number1', 'bank_name2',
        'account_number2', 'card_number2', 'shaba_number2', 'bank_name3', 'account_number3', 'card_number3', 'shaba_number3',
        'account_name1', 'account_name2', 'account_name3'
    ];

    public function marketings()
    {
        return $this->hasMany(Marketing::class);
    }
}
