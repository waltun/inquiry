<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractLoading extends Model
{
    use HasFactory;

    protected $fillable = [
        'number', 'file', 'date', 'type', 'contract_id'
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
