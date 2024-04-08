<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractFactor extends Model
{
    use HasFactory;

    protected $fillable = [
        'file', 'price', 'tax_price'
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
