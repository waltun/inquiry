<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'percent', 'quantity', 'quantity2', 'price', 'model_custom_name', 'description', 'type', 'invoice_id',
        'group_id', 'model_id', 'part_id'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
