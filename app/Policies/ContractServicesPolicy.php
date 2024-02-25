<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ContractServices;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContractServicesPolicy
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
        return $user->can('view_any_contract::services');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ContractServices  $contractServices
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, ContractServices $contractServices)
    {
        return $user->can('view_contract::services');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create_contract::services');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ContractServices  $contractServices
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, ContractServices $contractServices)
    {
        return $user->can('update_contract::services');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ContractServices  $contractServices
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, ContractServices $contractServices)
    {
        return $user->can('delete_contract::services');
    }

    /**
     * Determine whether the user can bulk delete.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function deleteAny(User $user)
    {
        return $user->can('delete_any_contract::services');
    }

    /**
     * Determine whether the user can permanently delete.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ContractServices  $contractServices
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, ContractServices $contractServices)
    {
        return $user->can('force_delete_contract::services');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDeleteAny(User $user)
    {
        return $user->can('force_delete_any_contract::services');
    }

    /**
     * Determine whether the user can restore.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ContractServices  $contractServices
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, ContractServices $contractServices)
    {
        return $user->can('restore_contract::services');
    }

    /**
     * Determine whether the user can bulk restore.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restoreAny(User $user)
    {
        return $user->can('restore_any_contract::services');
    }

    /**
     * Determine whether the user can replicate.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ContractServices  $contractServices
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function replicate(User $user, ContractServices $contractServices)
    {
        return $user->can('replicate_contract::services');
    }

    /**
     * Determine whether the user can reorder.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function reorder(User $user)
    {
        return $user->can('reorder_contract::services');
    }

}
