<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'manager', 'submit', 'inquiry_number', 'price', 'archive_at', 'user_id', 'marketer',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
