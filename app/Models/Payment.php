<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'price', 'text', 'date', 'type', 'account_id', 'contract_id', 'confirm'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
