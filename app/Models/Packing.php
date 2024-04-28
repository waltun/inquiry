<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packing extends Model
{
    use HasFactory;

    protected $fillable = [
        'date', 'contract_id', 'address', 'receiver', 'exit_at'
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function packs()
    {
        return $this->hasMany(Pack::class);
    }
}
