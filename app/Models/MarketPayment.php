<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'price', 'text', 'date', 'confirm', 'marketer_account_id', 'contract_id', 'marketing_id'
    ];

    public function marketing()
    {
        return $this->belongsTo(Marketing::class);
    }
}
