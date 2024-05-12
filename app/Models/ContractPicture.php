<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractPicture extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'file', 'contract_id', 'date'
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
