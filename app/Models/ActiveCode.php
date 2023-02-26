<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActiveCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'user_id', 'expired_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeGenerateCode($query, $user)
    {
        if ($code = $this->getActiveCode($user)) {
            $code = $code->code;
        } else {
            do {
                $code = random_int(1000, 9999);
            } while ($this->codeIsUnique($user, $code));

            $user->activeCode()->create([
                'code' => $code,
                'expired_at' => now()->addMinutes(2)
            ]);
        }

        return $code;
    }

    private function codeIsUnique($user, int $code)
    {
        return !!$user->activeCode()->whereCode($code)->first();
    }

    private function getActiveCode($user)
    {
        return $user->activeCode()->where('expired_at', '>', now())->first();
    }

    public function scopeVerifyCode($query, $code, $user)
    {
        return !!$user->activeCode()->whereCode($code)->where('expired_at', '>', now())->first();
    }
}
