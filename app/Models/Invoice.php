<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'price', 'description', 'user_id', 'inquiry_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function inquiry()
    {
        return $this->belongsTo(Inquiry::class);
    }

    public function products()
    {
        return $this->hasMany(InvoiceProduct::class);
    }
}
