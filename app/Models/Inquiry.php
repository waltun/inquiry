<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class
Inquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'submit', 'inquiry_number', 'price', 'archive_at', 'user_id', 'marketer', 'message',
        'description', 'type', 'copy_id', 'correction_id'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function inquiryPrices()
    {
        return $this->hasMany(InquiryPrice::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
