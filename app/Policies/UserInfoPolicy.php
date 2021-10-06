<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserInfoPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function own(User $user,UserInfo $i)
    {
        return $i->user_id == $user->id;
    }
}
