<?php

namespace App\Policies\Tenant\Admin;

use App\Models\Tenant\Admin\Attachment;

use App\Models\User;
use Illuminate\Auth\Access\Response;

use App\Helpers\CheckAccess;
use App\Enum\UserRoleEnum;

class AttachmentPolicy
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
    public function viewAny(User $user): Response
    {
        return CheckAccess::aboveAdmin($user->role->value)
            ? Response::allow()
            : Response::deny(config('akk.MSG_DENY'));
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Attachment $attachment): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Attachment $attachment): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Attachment $attachment): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Attachment $attachment): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Attachment $attachment): bool
    {
        //
    }
}
