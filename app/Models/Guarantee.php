<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guarantee extends Model
{
    use HasFactory;

    protected $fillable = [
        'price', 'date', 'text', 'code', 'type', 'return_date', 'confirm', 'receiver', 'account_id',
        'contract_id', 'due_date', 'final_return_date', 'customer_receiver', 'guarantee_type'
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
