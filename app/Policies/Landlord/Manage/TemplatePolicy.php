<?php

namespace App\Policies\Landlord\Manage;

use App\Models\Landlord\Admin\Template;
use App\Models\User;
use Illuminate\Auth\Access\Response;

use App\Enum\UserRoleEnum;

class TemplatePolicy
{
    /**
     * Perform pre-authorization checks.
     */
    public function before(User $user, string $ability): bool|null
    {
        if ($user->role->value == UserRoleEnum::SYSTEM->value) {
            return true;
        }
        return null;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Template $template): Response
    {
        return ($user->role->value == UserRoleEnum::SYSTEM->value)
            ? Response::allow()
            : Response::deny(config('akk.MSG_DENY'));
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return ($user->role->value == UserRoleEnum::SYSTEM->value)
            ? Response::allow()
            : Response::deny(config('akk.MSG_DENY'));
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Template $template): Response
    {
        return ($user->role->value == UserRoleEnum::SYSTEM->value)
            ? Response::allow()
            : Response::deny(config('akk.MSG_DENY'));
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Template $template): Response
    {
        return ($user->role->value == UserRoleEnum::SYSTEM->value)
            ? Response::allow()
            : Response::deny(config('akk.MSG_DENY'));
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Template $template): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Template $template): bool
    {
        //
    }
}