<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;
use App\Models\User;
use App\Models\Role;

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
        
        Gate::before(function ($user) {
            if ($user->role_id == 1) {
                return true;
            }
        });

        Gate::define('create-article', function(User $user){
            $role_id = Role::where('name', 'reader')->value('id');
            if ($user->role_id == $role_id) return Response::deny('Нет доступа');
            return Response::allow();
        });
        Gate::define('update-article', function(User $user){
            $role_id = Role::where('name', 'reader')->value('id');
            if ($user->role_id == $role_id) return Response::deny('Нет доступа');
            return Response::allow();
        });
        Gate::define('delete-article', function(User $user){
            $role_id = Role::where('name', 'reader')->value('id');
            if ($user->role_id == $role_id) return Response::deny('Нет доступа');
            return Response::allow();
        });
    }
}
