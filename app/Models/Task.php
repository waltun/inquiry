<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'date', 'done', 'level', 'user_id', 'receiver_id', 'file', 'done_at', 'reply', 'extension_count', 'extension_days', 'extension_usage', 'extension_days_request',
        'extension_days_request_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
