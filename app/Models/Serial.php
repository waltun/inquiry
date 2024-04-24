<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serial extends Model
{
    use HasFactory;

    protected $fillable = [
        'serial_number', 'contract_product_id', 'contract_id'
    ];

    public function contractProduct()
    {
        return $this->belongsTo(ContractProduct::class);
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
