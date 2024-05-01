<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractContract extends Model
{
    use HasFactory;

    protected $fillable = [
        'number', 'file', 'date', 'contract_id'
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
