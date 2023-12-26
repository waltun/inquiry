<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity', 'price', 'model_custom_name', 'description', 'type', 'tag', 'packing_id',
        'contract_id', 'group_id', 'model_id', 'part_id', 'product_id', 'status', 'end_at', 'invoice_id'
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function amounts()
    {
        return $this->hasMany(ContractProductAmount::class, 'contract_product_id');
    }

    public function spareAmounts()
    {
        return $this->hasMany(ContractProductAmountSpare::class, 'contract_product_id');
    }

    public function histories()
    {
        return $this->hasMany(ContractPartHistory::class);
    }

    public function packing()
    {
        return $this->belongsTo(Packing::class);
    }
}
