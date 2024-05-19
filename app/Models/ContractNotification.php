<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'message', 'current_url', 'next_url', 'next_message', 'read_at', 'done_at', 'contract_id', 'user_id'
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
