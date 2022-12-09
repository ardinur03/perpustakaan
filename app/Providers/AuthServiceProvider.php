<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
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
        // using spatie/laravel-permission package
        $this->registerPolicies();
        Gate::define('isPetugas', fn ($user) => $user->hasRole('petugas'));
        Gate::define('isAnggota', fn ($user) => $user->hasRole('member'));
        Gate::define('isSuperAdmin', fn ($user) => $user->hasRole('super-admin'));
    }
}
