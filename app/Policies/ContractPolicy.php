<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Contract;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContractPolicy
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
        return $user->can('view_any_contract');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Contract $contract)
    {
        return $user->can('view_contract');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create_contract');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Contract $contract)
    {
        if ($user->can('update_contract')) {
            if (auth()->user()->isAdmin()) return true;
            if (auth()->user()->notAdmin() and ($contract->manager?->id === auth()->user()->id)) return true;
            return false;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Contract $contract)
    {
        return $user->can('delete_contract');
    }

    /**
     * Determine whether the user can bulk delete.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function deleteAny(User $user)
    {
        return $user->can('delete_any_contract');
    }

    /**
     * Determine whether the user can permanently delete.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Contract $contract)
    {
        return $user->can('force_delete_contract');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDeleteAny(User $user)
    {
        return $user->can('force_delete_any_contract');
    }

    /**
     * Determine whether the user can restore.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Contract $contract)
    {
        return $user->can('restore_contract');
    }

    /**
     * Determine whether the user can bulk restore.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restoreAny(User $user)
    {
        return $user->can('restore_any_contract');
    }

    /**
     * Determine whether the user can replicate.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function replicate(User $user, Contract $contract)
    {
        return $user->can('replicate_contract');
    }

    /**
     * Determine whether the user can reorder.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function reorder(User $user)
    {
        return $user->can('reorder_contract');
    }
}
