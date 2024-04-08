<?php

namespace App\Models;

use App\Models\System\Letter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'marketer', 'number', 'price', 'start_contract_date', 'send_date', 'user_id', 'customer_id',
        'type', 'old_number', 'recipe', 'complete', 'file'
    ];

    public function products()
    {
        return $this->hasMany(ContractProduct::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function marketPayments()
    {
        return $this->hasMany(MarketPayment::class);
    }

    public function guarantees()
    {
        return $this->hasMany(Guarantee::class);
    }

    public function marketings()
    {
        return $this->hasMany(Marketing::class);
    }

    public function packings()
    {
        return $this->hasMany(Packing::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function letters()
    {
        return $this->hasMany(Letter::class);
    }

    public function contractFactors()
    {
        return $this->hasMany(ContractFactor::class);
    }
}
