<?php

namespace App\Models\System;

use App\Models\Contract;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    use HasFactory;

    protected $fillable = [
        'number', 'title', 'method', 'category', 'date', 'registrar', 'user_id', 'description', 'contract_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
