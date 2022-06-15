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

        Gate::before(function ($user, $ability) {
            if ($user->role === 'admin' || $user->role === 'it') {
                return true;
            }
        });

        Gate::define('users', function (User $user) {
            return $user->role === 'it' || $user->role === 'admin';
        });

        Gate::define('groups', function (User $user) {
            return $user->role === 'it' || $user->role === 'admin';
        });

        Gate::define('parts', function (User $user) {
            return $user->role === 'inventory';
        });

        Gate::define('part-price', function (User $user) {
            return $user->role === 'accounting';
        });

        Gate::define('part-collection', function (User $user) {
            return $user->role === 'it' || $user->role === 'admin';
        });

        Gate::define('inquiries', function (User $user) {
            return $user->role === 'sales-expert' || $user->role === 'inventory';
        });

        Gate::define('create-inquiry', function (User $user) {
            return $user->role === 'sales-expert';
        });

        Gate::define('inquiry-amounts', function (User $user) {
            return $user->role === 'inventory';
        });

        Gate::define('inquiry-detail', function (User $user) {
            return $user->role === 'it' || $user->role === 'admin';
        });

        Gate::define('inquiry-percent', function (User $user) {
            return $user->role === 'it' || $user->role === 'admin';
        });

        Gate::define('inquiry-restore', function (User $user) {
            return $user->role === 'it' || $user->role === 'admin';
        });
    }
}
