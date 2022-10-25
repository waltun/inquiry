<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amount extends Model
{
    use HasFactory;

    protected $fillable = [
        'value', 'part_id', 'product_id', 'price', 'sort'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
