<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketerAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank_name', 'account_number', 'shaba_number', 'card_number', 'account_name', 'marketer_id'
    ];

    public function marketer()
    {
        return $this->belongsTo(Marketer::class);
    }
}
