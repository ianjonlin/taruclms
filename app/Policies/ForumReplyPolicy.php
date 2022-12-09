<?php

namespace App\Policies;

use App\Models\ForumReply;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Access\HandlesAuthorization;

class ForumReplyPolicy
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
     * @param  \App\Models\ForumReply  $forumReply
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, ForumReply $forumReply)
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
        return !$user->isAdmin();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ForumReply  $forumReply
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, ForumReply $forumReply)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  $replyid
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, $replyid)
    {
        $forumReply = DB::table('forum_reply')->where('id', '=', $replyid)->get()->first();
        return $forumReply->created_by == $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ForumReply  $forumReply
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, ForumReply $forumReply)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ForumReply  $forumReply
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, ForumReply $forumReply)
    {
        return false;
    }
}
