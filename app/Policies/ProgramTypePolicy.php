<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ProgramType;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProgramTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->can('view_any_program::type');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProgramType  $programType
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, ProgramType $programType)
    {
        return $user->can('view_program::type');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create_program::type');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProgramType  $programType
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, ProgramType $programType)
    {
        return $user->can('update_program::type');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProgramType  $programType
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, ProgramType $programType)
    {
        return $user->can('delete_program::type');
    }

    /**
     * Determine whether the user can bulk delete.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function deleteAny(User $user)
    {
        return $user->can('delete_any_program::type');
    }

    /**
     * Determine whether the user can permanently delete.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProgramType  $programType
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, ProgramType $programType)
    {
        return $user->can('force_delete_program::type');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDeleteAny(User $user)
    {
        return $user->can('force_delete_any_program::type');
    }

    /**
     * Determine whether the user can restore.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProgramType  $programType
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, ProgramType $programType)
    {
        return $user->can('restore_program::type');
    }

    /**
     * Determine whether the user can bulk restore.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restoreAny(User $user)
    {
        return $user->can('restore_any_program::type');
    }

    /**
     * Determine whether the user can replicate.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProgramType  $programType
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function replicate(User $user, ProgramType $programType)
    {
        return $user->can('replicate_program::type');
    }

    /**
     * Determine whether the user can reorder.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function reorder(User $user)
    {
        return $user->can('reorder_program::type');
    }

}
