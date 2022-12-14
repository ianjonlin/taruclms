<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(Course::class, 'course');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search_title = "";
        $search_code = "";
        $search_cc = "";

        if ($request->get('title') != null)
            $search_title = $request->title;
        if ($request->get('code') != null)
            $search_code = $request->code;
        if ($request->get('cc') != null)
            $search_cc = $request->cc;

        if ($request->get('title') != null && $request->get('code') != null && $request->get('cc') != null) {
            $courses = Course::sortable()
                ->join('users', 'cc_id', '=', 'users.id')
                ->where('title', 'LIKE', "%{$search_title}%")
                ->where('code', 'LIKE', "%{$search_code}%")
                ->where(function ($query) use ($search_cc) {
                    $query->where('users.user_id', 'LIKE', "%{$search_cc}%")
                        ->orWhere('users.name', 'LIKE', "%{$search_cc}%");
                })
                ->get();
        } else if ($request->get('title') != null && $request->get('code') != null) {
            $courses = Course::sortable()
                ->where('title', 'LIKE', "%{$search_title}%")
                ->where('code', 'LIKE', "%{$search_code}%")
                ->get();
        } else if ($request->get('title') != null && $request->get('cc') != null) {
            $courses = Course::sortable()
                ->join('users', 'cc_id', '=', 'users.id')
                ->where('title', 'LIKE', "%{$search_title}%")
                ->where(function ($query) use ($search_cc) {
                    $query->where('users.user_id', 'LIKE', "%{$search_cc}%")
                        ->orWhere('users.name', 'LIKE', "%{$search_cc}%");
                })
                ->get();
        } else if ($request->get('code') != null && $request->get('cc') != null) {
            $courses = Course::sortable()
                ->join('users', 'cc_id', '=', 'users.id')
                ->where('code', 'LIKE', "%{$search_code}%")
                ->where(function ($query) use ($search_cc) {
                    $query->where('users.user_id', 'LIKE', "%{$search_cc}%")
                        ->orWhere('users.name', 'LIKE', "%{$search_cc}%");
                })
                ->get();
        } else if ($request->get('title') != null) {
            $courses = Course::sortable()
                ->where('title', 'LIKE', "%{$search_title}%")
                ->get();
        } else if ($request->get('code') != null) {
            $courses = Course::sortable()
                ->where('code', 'LIKE', "%{$search_code}%")
                ->get();
        } else if ($request->get('cc') != null) {
            $courses = Course::sortable()
                ->join('users', 'cc_id', '=', 'users.id')
                ->where(function ($query) use ($search_cc) {
                    $query->where('users.user_id', 'LIKE', "%{$search_cc}%")
                        ->orWhere('users.name', 'LIKE', "%{$search_cc}%");
                })
                ->get();
        } else {
            $courses = Course::sortable()->get();
        }

        $users = DB::table('users')->get();
        return view('pages.admin.course.index', ['courses' => $courses, 'users' => $users, 'search_title' => $search_title, 'search_code' => $search_code, 'search_cc' => $search_cc]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cc_ids = array();
        $courses = DB::table('course')->get();
        $users = DB::table('users')->where('role', '=', 'Lecturer')->get();
        return view('pages.admin.course.create', ['cc_ids' => $cc_ids, 'courses' => $courses, 'users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:course,code',
            'title' => 'required',
            'cc_id' => 'required', 'unique:course,cc_id' => 'Lecturer is already a CC!'
        ]);

        $course = new Course;
        $course->code = $request->code;
        $course->title = $request->title;
        $course->cc_id = $request->cc_id;

        if ($course->save()) {
            return redirect()->route('course.index')->with('success', 'Course created successfully!');
        } else {
            return redirect()->route('course.index')->with('error', 'Course cannot be created.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course $course
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course, Request $request)
    {
        if ($request->get('keyword') != null) {
            $assigned_lecturers = DB::table('assigned_course')
                ->join('users', 'lecturer_id', '=', 'users.id')
                ->select('users.id as id', 'users.user_id as user_id', 'users.name as name')
                ->where('assigned_course.course_id', '=', $course->id)
                ->where('users.user_id', 'LIKE', "%{$request->keyword}%")
                ->orWhere('users.name', 'LIKE', "%{$request->keyword}%")
                ->get();
        } else {
            $assigned_lecturers = DB::table('assigned_course')
                ->join('users', 'lecturer_id', '=', 'users.id')
                ->select('users.id as id', 'users.user_id as user_id', 'users.name as name')
                ->where('assigned_course.course_id', '=', $course->id)
                ->get();
        }

        $lecturers = DB::table('users')
            ->where('role', '=', 'Lecturer')
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('course')
                    ->whereColumn('course.cc_id', 'users.id');
            })
            ->get();

        return view('pages.admin.course.lecturers', ['course' => $course, 'assigned_lecturers' => $assigned_lecturers, 'lecturers' => $lecturers, 'search_keyword' => $request->keyword]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        $cc_ids = array();
        $courses = DB::table('course')->get();
        $users = DB::table('users')->where('role', '=', 'Lecturer')->get();
        return view('pages.admin.course.edit', ['course' => $course, 'cc_ids' => $cc_ids, 'courses' => $courses, 'users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'code' => 'required',
            'title' => 'required',
            'cc_id' => 'required'
        ]);

        $course->code = $request->code;
        $course->title = $request->title;
        $course->cc_id = $request->cc_id;

        if ($course->save()) {
            return redirect()->route('course.index')->with('success', 'Course updated successfully!');
        } else {
            return redirect()->route('course.index')->with('error', 'Course cannot be updated.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $lmmaterials = DB::table('learning_material')
            ->join('lm_category', 'learning_material.category_id', '=', 'lm_category.id')
            ->join('course', 'lm_category.course_id', '=', 'course.id')
            ->select('learning_material.id as id', 'learning_material.path as path')
            ->where('lm_category.course_id', '=', $course->id)
            ->get();
        $lmcategories = DB::table('lm_category')
            ->join('course', 'lm_category.course_id', '=', 'course.id')
            ->select('lm_category.id as id')
            ->where('course.id', '=', $course->id)
            ->get();
        $lmdirectoryPath = 'uploads/learningmaterials/' . $course->code;

        if (Storage::deleteDirectory($lmdirectoryPath)) {
            foreach ($lmmaterials as $lmmaterial)
                DB::table('learning_material')->where('id', '=', $lmmaterial->id)->delete();
            foreach ($lmcategories as $lmcategory)
                DB::table('lm_category')->where('id', '=', $lmcategory->id)->delete();
        }

        $cmmaterials = DB::table('course_material')
            ->join('cm_category', 'course_material.category_id', '=', 'cm_category.id')
            ->join('course', 'cm_category.course_id', '=', 'course.id')
            ->select('course_material.id as id', 'course_material.path as path')
            ->where('cm_category.course_id', '=', $course->id)
            ->get();
        $cmcategories = DB::table('cm_category')
            ->join('course', 'cm_category.course_id', '=', 'course.id')
            ->select('cm_category.id as id')
            ->where('course.id', '=', $course->id)
            ->get();
        $cmdirectoryPath = 'uploads/coursematerials/' . $course->code;

        if (Storage::deleteDirectory($cmdirectoryPath)) {
            foreach ($cmmaterials as $cmmaterial)
                DB::table('course_material')->where('id', '=', $cmmaterial->id)->delete();
            foreach ($cmcategories as $cmcategory)
                DB::table('cm_category')->where('id', '=', $cmcategory->id)->delete();
        }

        DB::table('assigned_course')
            ->where('course_id', '=', $course->id)
            ->delete();

        DB::table('programme_structure')
            ->where('course_id', '=', $course->id)
            ->delete();

        if ($course->delete()) {
            return back()->with('success', 'Course deleted successfully!');
        }
        return back()->with('error', "Course cannot not deleted.");
    }

    /**
     * View Course
     *
     * @param  $courseCode
     * @return \Illuminate\Http\Response
     */
    public function viewCourse($courseCode)
    {
        $course = DB::table('course')->where('code', '=', $courseCode)->get()->first();

        $forumposts = DB::table('forum_post')
            ->join('users', 'forum_post.created_by', '=', 'users.id')
            ->select('forum_post.id as id', 'forum_post.title as title', 'forum_post.body as body', 'users.name as name', 'forum_post.created_by as created_by', 'forum_post.created_at as created_at')
            ->where('forum_post.course_id', '=', $course->id)
            ->orderBy('forum_post.id', 'desc')
            ->get();
        foreach ($forumposts as $post) {
            $replyCount = DB::table('forum_reply')
                ->where('forum_id', '=', $post->id)
                ->count();
            $post->replyCount = $replyCount;
        }

        $lMCategories = DB::table('lm_category')
            ->where('course_id', '=', $course->id)
            ->get();
        $learningMaterials = DB::table('learning_material')
            ->join('lm_category', 'category_id', '=', 'lm_category.id')
            ->select('learning_material.id as id', 'learning_material.name as name', 'lm_category.id as category', 'learning_material.type as type', 'learning_material.path as path', 'learning_material.ext as ext',)
            ->where('lm_category.course_id', '=', $course->id)
            ->get();

        $cMCategories = DB::table('cm_category')
            ->where('course_id', '=', $course->id)
            ->get();
        $courseMaterials = DB::table('course_material')
            ->join('cm_category', 'category_id', '=', 'cm_category.id')
            ->select('course_material.id as id', 'course_material.name as name', 'cm_category.id as category', 'course_material.type as type', 'course_material.path as path', 'course_material.ext as ext',)
            ->where('cm_category.course_id', '=', $course->id)
            ->get();

        return view('pages.user.course', ['course' => $course, 'forumposts' => $forumposts, 'lMCategories' => $lMCategories, 'learningMaterials' => $learningMaterials, 'cMCategories' => $cMCategories, 'courseMaterials' => $courseMaterials]);
    }

    /**
     * Edit Course Details
     *
     * @param  $courseCode
     * @return \Illuminate\Http\Response
     */
    public function editDetails($courseCode)
    {
        $course = DB::table('course')->where('code', '=', $courseCode)->get()->first();
        if ($course->cc_id != auth()->user()->id)
            abort(403, "Unauthorized Action.");

        return view('pages.user.coursedetails.details', ['course' => $course]);
    }

    /**
     * Update Course Details
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $courseCode
     * @return \Illuminate\Http\Response
     */
    public function updateDetails(Request $request, $courseCode)
    {
        $status = DB::table('course')->where('code', '=', $courseCode)->update(['details' => $request->details]);

        if ($status) {
            return redirect()->route('viewCourse', ['courseCode' => $courseCode])->with('success', 'Course Details updated successfully!');
        } else {
            return redirect()->route('viewCourse', ['courseCode' => $courseCode])->with('error', 'Course Details cannot be updated.');
        }
    }

    /**
     * Add Lecturer
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addLecturer(Request $request)
    {
        $request->validate([
            'lecturer_id' => 'required'
        ]);

        $status = DB::table('assigned_course')->insert([
            'lecturer_id' => $request->lecturer_id,
            'course_id' => $request->course_id
        ]);

        if ($status) {
            return back()->with('success', 'Lecturer added successfully!');
        } else {
            return back()->with('error', 'Lecturer cannot be added.');
        }
    }

    /**
     * Remove Lecturer
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteLecturer(Request $request)
    {
        $status = DB::table('assigned_course')
            ->where([
                ['lecturer_id', '=', $request->lecturer_id],
                ['course_id', '=', $request->course_id]
            ])
            ->delete();

        if ($status) {
            return back()->with('success', 'Lecturer deleted successfully!');
        } else {
            return back()->with('error', 'Lecturer cannot be deleted.');
        }
    }
}
