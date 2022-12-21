<?php

namespace App\Http\Controllers;

use App\Models\ForumPost;
use App\Models\ForumReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ForumController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(ForumPost::class, 'forumPost');
        $this->authorizeResource(ForumReply::class, 'forumReply');
    }

    /**
     * Redirect to Create Forum Post
     *
     */
    public function createForumPost($courseCode)
    {
        if (auth()->user()->role != "Student")
            abort(403, "Unauthorized Action.");

        return view('pages.user.forum.create', ['courseCode' => $courseCode]);
    }

    /**
     * Store New Forum Post
     *
     */
    public function storeForumPost($courseCode, Request $request)
    {
        $request->validate([
            'title' => 'required|unique:forum_post,title',
            'body' => 'required',
        ]);

        // Check for restricted keywords
        $blocked_keywords = DB::table('blocked_keywords')
            ->select('value')
            ->get();

        foreach ($blocked_keywords as $keyword) {
            $bk[] = $keyword->value;
        }

        if (Str::contains($request->title, $bk)) {
            return back()->withErrors('Your post title contains restricted or implicit keywords.');
        } else if (Str::contains($request->body, $bk)) {
            return back()->withErrors('Your post body contains restricted or implicit keywords.');
        }

        $course = DB::table('course')->where('code', '=', $courseCode)->get()->first();

        $forumpost = new ForumPost;
        $forumpost->course_id = $course->id;
        $forumpost->created_at = now("Asia/Kuala_Lumpur")->toDateTimeString();
        $forumpost->created_by = auth()->user()->id;
        $forumpost->title = $request->title;
        $forumpost->body = $request->body;

        if ($forumpost->save()) {
            return redirect()->route('viewForumPostAll', ['courseCode' => $courseCode])->with('success', 'Forum Post created successfully!');
        } else {
            return redirect()->route('viewForumPostAll', ['courseCode' => $courseCode])->with('error', 'Forum post cannot be created.');
        }
    }

    /**
     * View All Forum Post
     *
     */
    public function viewForumPostAll($courseCode)
    {
        $course = DB::table('course')->where('code', '=', $courseCode)->get()->first();
        $userposts = DB::table('forum_post')
            ->where('course_id', '=', $course->id)
            ->where('created_by', '=', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();
        foreach ($userposts as $post) {
            $replyCount = DB::table('forum_reply')
                ->where('forum_id', '=', $post->id)
                ->count();
            $post->replyCount = $replyCount;
        }
        $forumposts = DB::table('forum_post')
            ->join('users', 'forum_post.created_by', '=', 'users.id')
            ->select('forum_post.id as id', 'forum_post.title as title', 'forum_post.body as body', 'users.name as name', 'forum_post.created_by as created_by', 'forum_post.created_at as created_at')
            ->where('forum_post.course_id', '=', $course->id)
            ->orderBy('forum_post.created_at', 'desc')
            ->get();
        foreach ($forumposts as $post) {
            $replyCount = DB::table('forum_reply')
                ->where('forum_id', '=', $post->id)
                ->count();
            $post->replyCount = $replyCount;
        }
        return view('pages.user.forum.viewall', ['course' => $course, 'userposts' => $userposts, 'forumposts' => $forumposts]);
    }

    /**
     * Redirect to View Forum Post
     *
     */
    public function viewForumPost($courseCode, $id)
    {
        $course = DB::table('course')->where('code', '=', $courseCode)->get()->first();
        $post = DB::table('forum_post')
            ->join('users', 'forum_post.created_by', '=', 'users.id')
            ->select('forum_post.id as id', 'forum_post.title as title', 'forum_post.body as body', 'users.name as name', 'forum_post.created_by as created_by', 'forum_post.created_at as created_at')
            ->where('forum_post.id', '=', $id)
            ->get()
            ->first();
        $replies = DB::table('forum_reply')
            ->join('users', 'forum_reply.created_by', '=', 'users.id')
            ->select('forum_reply.id as id', 'forum_reply.body as body', 'users.name as name', 'users.role as role', 'forum_reply.created_by as created_by', 'forum_reply.created_at as created_at')
            ->where('forum_reply.forum_id', '=', $id)
            ->orderBy('forum_reply.created_at', 'asc')
            ->get();
        return view('pages.user.forum.viewpost', ['course' => $course, 'post' => $post, 'replies' => $replies]);
    }

    /**
     * Delete all Forum Replies and the selected Forum Post
     *
     */
    public function deleteForumPost($courseCode, $id, Request $request)
    {
        if ($request->user()->cannot('delete', [ForumPost::class, $id])) {
            abort(403, "Unauthorized Action.");
        }

        DB::table('forum_reply')->where('forum_id', '=', $id)->delete();
        $statusPost = DB::table('forum_post')->where('id', '=', $id)->delete();
        if ($statusPost)
            return back()->with('success', 'Forum Post deleted successfully!');
        else
            return back()->with('error', "Forum Post cannot not deleted.");
    }

    /**
     * Store New Forum Post
     *
     */
    public function storeForumReply($courseCode, $id, Request $request)
    {
        $request->validate([
            'reply' => 'required',
        ]);

        // Check for restricted keywords
        $blocked_keywords = DB::table('blocked_keywords')
            ->select('value')
            ->get();

        foreach ($blocked_keywords as $keyword) {
            $bk[] = $keyword->value;
        }

        if (Str::contains($request->reply, $bk)) {
            return back()->withErrors('Your reply contains restricted or implicit keywords.');
        }

        $forumreply = new ForumReply;
        $forumreply->forum_id = $id;
        $forumreply->created_at = now("Asia/Kuala_Lumpur")->toDateTimeString();
        $forumreply->created_by = auth()->user()->id;
        $forumreply->body = $request->reply;

        if ($forumreply->save()) {
            return back()->with('success', 'Forum Reply created successfully!');
        } else {
            return back()->with('error', 'Forum Reply cannot be created.');
        }
    }

    /**
     * Delete Forum Reply
     *
     */
    public function deleteForumReply($courseCode, $id, Request $request)
    {
        if ($request->user()->cannot('delete', [ForumReply::class, $id])) {
            abort(403, "Unauthorized Action.");
        }

        $status = DB::table('forum_reply')
            ->where('id', '=', $id)
            ->delete();

        if ($status) {
            return back()->with('success', 'Forum Reply deleted successfully!');
        } else {
            return back()->with('error', "Forum Reply cannot not deleted.");
        }
    }
}
