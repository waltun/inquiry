<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('create-group', function (User $user) {
            return $user->role === 'it' || $user->role === 'admin';
        });

        Gate::define('create-part', function (User $user) {
            return $user->role === 'inventory';
        });

        Gate::define('part-price', function (User $user) {
            return $user->role === 'accounting';
        });

        Gate::define('create-inquiry', function (User $user) {
            return $user->role === 'sales-expert';
        });

        Gate::define('inquiry-value', function (User $user) {
            return $user->role === 'sales-expert';
        });
    }
}
