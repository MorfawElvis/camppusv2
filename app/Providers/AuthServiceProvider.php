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
        $this->registerPolicies();

        Gate::define('isAdmin', function ($user){
            return $user->role_id == 1;
        });
        Gate::define('isTeacher', function ($user){
            return $user->role_id == 2;
        });
        Gate::define('isAccountant', function ($user){
            return $user->role_id == 3;
        });
        Gate::define('isSuperAdmin', function ($user){
            return $user->role_id == 4;
        });
        Gate::define('isLibrarian', function ($user){
            return $user->role_id == 5;
        });
        Gate::define('isDormitorySuperintendent', function ($user){
            return $user->role_id == 6;
        });
        Gate::define('isStudent', function ($user){
            return $user->role_id == 7;
        });
    }
}
