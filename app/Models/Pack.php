<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pack extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'unit', 'weight', 'packing_id', 'code', 'length', 'width', 'height', 'type'
    ];

    public function products()
    {
        return $this->belongsToMany(ContractProduct::class)->withPivot(['quantity']);
    }

    public function packing()
    {
        return $this->belongsTo(Packing::class);
    }
}
