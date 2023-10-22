<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractPartHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'old_part_id', 'new_part_id', 'contract_product_id', 'contract_id', 'user_id', 'type'
    ];

    public function product()
    {
        return $this->belongsTo(ContractProduct::class);
    }
}
