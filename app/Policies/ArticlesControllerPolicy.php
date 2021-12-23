<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Role;
use App\Models\odel;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;


class ArticlesControllerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */

    public function before(){

    }
    
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\odel  $odel
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, odel $odel)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
         $role = Role::where('name', 'reader')->value('id');
            if($user->role_id == $role){
                return Response::deny('В доступе отказано!');
            } return Response::allow();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\odel  $odel
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, odel $odel)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\odel  $odel
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, odel $odel)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\odel  $odel
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, odel $odel)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\odel  $odel
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, odel $odel)
    {
        //
    }
}
