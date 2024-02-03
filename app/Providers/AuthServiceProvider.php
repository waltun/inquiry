<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    public function boot()
    {
        $this->registerPolicies();

        // Gate::before(function ($user) {
        //     if ($user->role == 'admin') {
        //         return true;
        //     }
        // });

        // foreach (Permission::all() as $permission) {
        //     Gate::define($permission->name, function ($user) use ($permission) {
        //         return $user->hasPermission($permission);
        //     });
        // }
    }
}
