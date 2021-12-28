<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Role;
use Illuminate\Auth\Access\Response;

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

        Gate::define('moderator',function(User $user){
            $role = Role::where('name', 'moderator')->value('id');
            if ($user->role_id == $role) return true;
        });

        Gate::define('update-article', function(?User $user){
            $role = Role::where('name', 'reader')->value('id');
            if ($user->role_id == $role) return Response::deny('Нет доступа');
            return Response::allow();
        });
        Gate::define('delete-article', function(?User $user){
            $role = Role::where('name', 'reader')->value('id');
            if ($user->role_id == $role) return Response::deny('Нет доступа');
            return Response::allow('bla bla');
        });
        
    }
}
