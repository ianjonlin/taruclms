<?php

namespace App\Policies;

use App\Models\CourseMaterial;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Access\HandlesAuthorization;

class CourseMaterialPolicy
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
        if (auth()->user()->role == 'Student')
            return false;

        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CourseMaterial  $courseMaterial
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, CourseMaterial $courseMaterial)
    {
        if (auth()->user()->role == 'Student')
            return false;

        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @param  $courseCode
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user, $courseCode)
    {
        $course = DB::table('course')->where('code', '=', $courseCode)->get()->first();
        return $course->cc_id == $user->id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  $courseCode
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, $courseCode)
    {
        $course = DB::table('course')->where('code', '=', $courseCode)->get()->first();
        return $course->cc_id == $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  $courseCode
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, $courseCode)
    {
        $course = DB::table('course')->where('code', '=', $courseCode)->get()->first();
        return $course->cc_id == $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CourseMaterial  $courseMaterial
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, CourseMaterial $courseMaterial)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CourseMaterial  $courseMaterial
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, CourseMaterial $courseMaterial)
    {
        return false;
    }
}
