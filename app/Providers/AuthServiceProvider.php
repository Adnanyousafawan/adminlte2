<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        
       // $gate->define('isAdmin', function($users)
        Gate::define('isAdmin', function($user)
        {
            return $user->role_id == '1';
        });
         Gate::define('isManager', function($user)
        {
            return $user->role_id == '2';
        });
          Gate::define('isContractor', function($user)
        {
            return $user->role_id == '3';
        });


/*
       $gate->define('isManager', function($users)
        {
            return $user->role_id == '2';
        });
        
        $gate->define('isContractor', function($users)
        {
            return $user->role_id == '3';
        });
        */



//        Passport::routes();
    }
}
