<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
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

        Gate::define('admin', function ($user) {
            return $user->type_id == 1;
        });

        Gate::define('client', function ($user) {
            return $user->type_id == 2;
        });

        Gate::define('storekeeper', function ($user) {
            return $user->type_id == 3;
        });

        Gate::define('director', function ($user) {
            return $user->type_id == 4;
        });

        Gate::define('accountant', function ($user) {
            return $user->type_id == 5;
        });

        Gate::define('courier', function ($user) {
            return $user->type_id == 6;
        });

        // Gate::allows('client');
    }
}
