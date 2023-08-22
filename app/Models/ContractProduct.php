<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity', 'price', 'model_custom_name', 'description', 'type', 'delivery_date', 'warranty_date', 'tag',
        'contract_id', 'group_id', 'model_id', 'part_id',
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
