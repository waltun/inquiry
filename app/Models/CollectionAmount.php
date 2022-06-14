<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollectionAmount extends Model
{
    use HasFactory;

    protected $fillable = [
        'value', 'part_id', 'collection_id'
    ];

    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }
}
