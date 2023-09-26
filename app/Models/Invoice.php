<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'price', 'description', 'complete', 'tax', 'user_id', 'inquiry_id', 'buyer_name', 'buyer_position', 'invoice_number'
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

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }
}
