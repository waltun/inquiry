<?php

namespace App\Providers;

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

        Gate::before(function ($user, $ability) {
            if ($user->role === 'admin' || $user->role === 'it') {
                return true;
            }
        });

        Gate::define('users', function (User $user) {
            return $user->role === 'admin' || $user->role === 'it';
        });

        Gate::define('categories', function (User $user) {
            return $user->role === 'technical';
        });

        Gate::define('price', function (User $user) {
            return $user->role === 'price' || $user->role === 'logistic' || $user->role === 'sale-manager';
        });

        Gate::define('collections', function (User $user) {
            return $user->role === 'sale-manager';
        });

        Gate::define('groups', function (User $user) {
            return $user->role === 'technical';
        });

        Gate::define('parts', function (User $user) {
            return $user->role === 'price' || $user->role === 'technical';
        });

        Gate::define('inquiries', function (User $user) {
            return $user->role === 'technical' || $user->role === 'sale-manager' || $user->role === 'sale-expert';
        });

        Gate::define('create-inquiry', function (User $user) {
            return $user->role === 'technical' || $user->role === 'sale-manager' || $user->role === 'sale-expert';
        });

        Gate::define('submit-inquiry', function (User $user) {
            return $user->role === 'technical' || $user->role === 'sale-manager' || $user->role === 'sale-expert';
        });

        Gate::define('delete-inquiry', function (User $user) {
            return $user->role === 'technical' || $user->role === 'sale-manager' || $user->role === 'sale-expert';
        });

        Gate::define('correction-inquiry', function (User $user) {
            return $user->role === 'technical' || $user->role === 'sale-manager';
        });

        Gate::define('percent-inquiry', function (User $user) {
            return $user->role === 'admin' || $user->role === 'it';
        });

        Gate::define('coil-table', function (User $user) {
            return $user->role === 'admin' || $user->role === 'it';
        });

        Gate::define('priced-inquiry', function (User $user) {
            return $user->role === 'technical' || $user->role === 'sale-manager' || $user->role === 'sale-expert';
        });

        Gate::define('detail-inquiry', function (User $user) {
            return $user->role === 'technical';
        });

        Gate::define('current-price', function (User $user) {
            return $user->role === 'agent' || $user->role === 'technical' || $user->role === 'sale-manager' || $user->role === 'sale-expert';
        });

        Gate::define('all', function (User $user) {
            return $user->role === 'technical' || $user->role === 'sale-manager' || $user->role === 'sale-expert' ||
                $user->role === 'admin' || $user->role === 'it' || $user->role === 'price' || $user->role === 'logistic';
        });
    }
}
