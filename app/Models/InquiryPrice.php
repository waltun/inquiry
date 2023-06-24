<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InquiryPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'part_id', 'inquiry_id', 'product_id'
    ];

    public function parts()
    {
        return $this->hasMany(Part::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function inquiry()
    {
        return $this->belongsTo(Inquiry::class);
    }
}
