<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function view($user)
    {
        return is_admin($user);
    }
}
