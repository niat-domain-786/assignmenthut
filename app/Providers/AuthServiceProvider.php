<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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

        // Gate::define('isAdmin', function($user){
        //     $roles = $user->roles->pluck('name')->toArray();
        //     return in_array('admin', $roles);
        // });
        Gate::define('isAdmin', function($user){
          
            return $user->isAdmin;
        });
        Gate::define('isUser', function($user){
          
            if( !($user->isAdmin) ) {
                return True;
            }
        });
    }
}
