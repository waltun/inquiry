<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'number', 'customer_number', 'period', 'price', 'tax', 'build_date', 'delivery_date', 'start_contract_date',
        'sale_service_date', 'send_date', 'invoice_id'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function products()
    {
        return $this->hasMany(ContractProduct::class);
    }
}
