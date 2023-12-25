<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractProductAmount extends Model
{
    use HasFactory;

    protected $fillable = [
        'value', 'value2', 'price', 'sort', 'weight', 'part_id', 'contract_product_id', 'buyer_manage', 'buyer', 'status', 'user_id'
    ];

    public function product()
    {
        return $this->belongsTo(ContractProduct::class, 'contract_product_id');
    }

    public function part()
    {
        return $this->belongsTo(Part::class, 'part_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
