<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'code', 'nation', 'address', 'confirmed_address', 'postal', 'registration_number', 'agent_name',
        'agent_phone', 'telephone', 'email', 'social_phone', 'manager_name', 'manager_phone', 'delivery_address',
        'technical_agent_name', 'technical_agent_phone', 'phone', 'type'
    ];

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }
}
