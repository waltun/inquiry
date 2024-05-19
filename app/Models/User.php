<?php

namespace App\Models;

use App\Models\System\Letter;
use App\Models\System\Purchase;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name', 'email', 'password', 'phone', 'gender', 'nation', 'role', 'active', 'internal_number', 'sign', 'company'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function inquiryPrices()
    {
        return $this->hasMany(InquiryPrice::class);
    }

    public function activeCode()
    {
        return $this->hasMany(ActiveCode::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function hasPermission($permission)
    {
        return $this->permissions->contains('name', $permission->name) || $this->hasRole($permission->roles);
    }

    public function hasRole($roles)
    {
        return !!$roles->intersect($this->roles)->all();
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function marketings()
    {
        return $this->hasMany(Marketing::class);
    }

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    public function marketers()
    {
        return $this->hasMany(Marketer::class);
    }

    public function inquiries()
    {
        return $this->belongsToMany(Inquiry::class);
    }

    public function invoices()
    {
        return $this->belongsToMany(Invoice::class);
    }

    public function contractProductAmounts()
    {
        return $this->hasMany(ContractProductAmount::class);
    }

    public function todos()
    {
        return $this->hasMany(Todo::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'user_id');
    }

    public function letters()
    {
        return $this->hasMany(Letter::class);
    }

    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }

    public function contractNotifications()
    {
        return $this->hasMany(ContractNotification::class);
    }
}
