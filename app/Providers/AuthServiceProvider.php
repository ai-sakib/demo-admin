<?php

namespace App\Providers;

use Laravel\Passport\Passport;
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
         'App\Model' => 'App\Policies\ModelPolicy',
        
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isAdmin', function($user){
            return $user->userRole->role_id === 1;
        });
        Gate::define('isGO', function($user){
            return $user->userRole->role_id === 2;
        });
        Gate::define('isPS', function($user){
            return $user->userRole->role_id === 3;
        });
        Gate::define('isAdminOrGO', function($user){
            if($user->userRole->role_id === 1 || $user->userRole->role_id === 2){
                return true;
            }
        });

        Passport::routes();
    }
}
