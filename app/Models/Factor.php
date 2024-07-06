<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factor extends Model
{
    use HasFactory;

    protected $fillable = [
        'date', 'description', 'number', 'contract_id', 'user_id'
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contractProducts()
    {
        return $this->belongsToMany(ContractProduct::class)->withPivot(['quantity']);
    }
}
