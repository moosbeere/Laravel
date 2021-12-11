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

        Gate::define('moderator',function (User $user) {
            if ($user->id  == 1) {
                return true;
            }
        });

        Gate::define('create-articles', function(User $user){
            $role = Role::where('name', 'reader')->value('id');
            if ($user->role_id == $role){
                return Response::deny('нет прав!');
            }
            return Response::allow();
        });

        Gate::define('update-articles', function(User $user){
            $role = Role::where('name', 'reader')->value('id');
            if ($user->role_id == $role){
                return Response::deny('нет прав!');
            }
            return Response::allow();
        });
        
        Gate::define('delete-articles', function(User $user){
            $role = Role::where('name', 'reader')->value('id');
            if ($user->role_id == $role){
                return Response::deny('нет прав!');
            }
            return Response::allow();
        });
    }
}
