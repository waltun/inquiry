<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'percent', 'quantity', 'quantity2', 'price', 'invoice_id'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
