<?php

namespace App\Policies\Tenant\Workflow;

use App\Models\Tenant\Workflow\Hierarchy;
use App\Models\User;
use Illuminate\Auth\Access\Response;

use App\Helpers\CheckAccess;
use App\Enum\UserRoleEnum;

class HierarchyPolicy
{
    /**
     * Perform pre-authorization checks.
    */
    public function before(User $user, string $ability): bool|null
    {
        if ( $user->role->value == UserRoleEnum::SYSTEM->value) {
            return true;
        }
        return null;
    }
    
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Hierarchy $hierarchy): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        //  Admin role user only
        return ( $user->role->value == UserRoleEnum::ADMIN->value || CheckAccess::isBackOffice($user->role->value) )
            ? Response::allow()
            : Response::deny(config('akk.MSG_DENY'));
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Hierarchy $hierarchy): Response
    {
        return ( $user->role->value == UserRoleEnum::ADMIN->value || CheckAccess::isBackOffice($user->role->value) )
             ? Response::allow()
             : Response::deny(config('akk.MSG_DENY'));
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Hierarchy $hierarchy): Response
    {
        return ( $user->role->value == UserRoleEnum::ADMIN->value || CheckAccess::isBackOffice($user->role->value) )
             ? Response::allow()
             : Response::deny(config('akk.MSG_DENY'));
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Hierarchy $hierarchy): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Hierarchy $hierarchy): bool
    {
        //
    }
}
