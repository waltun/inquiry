<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packing extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'unit', 'weight', 'contract_id', 'code', 'length', 'width', 'height', 'type'
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function products()
    {
        return $this->belongsToMany(ContractProduct::class)->withPivot(['quantity']);
    }
}
