<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractDocument extends Model
{
    use HasFactory;

    protected $fillable = [
      'name', 'file', 'date', 'contract_id'
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
