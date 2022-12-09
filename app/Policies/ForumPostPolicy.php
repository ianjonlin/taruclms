<?php

namespace App\Policies;

use App\Models\ForumPost;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Access\HandlesAuthorization;

class ForumPostPolicy
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
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ForumPost  $forumPost
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, ForumPost $forumPost)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->isStudent();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ForumPost  $forumPost
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, ForumPost $forumPost)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  $postid
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, $postid)
    {
        $forumpost = DB::table('forum_post')->where('id', '=', $postid)->get()->first();
        return $forumpost->created_by == $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ForumPost  $forumPost
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, ForumPost $forumPost)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ForumPost  $forumPost
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, ForumPost $forumPost)
    {
        return false;
    }
}
