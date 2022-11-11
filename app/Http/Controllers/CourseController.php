<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        if ($request->has('title') && $request->title != "") {
            $courses = Course::sortable()
                ->where('title', 'LIKE', "%{$request->title}%")
                ->get();
        } else if ($request->has('code') && $request->code != "") {
            $courses = Course::sortable()
                ->where('code', 'LIKE', "%{$request->code}%")
                ->get();
        } else if ($request->has('cc') && $request->cc != "") {
            $courses = Course::sortable()
                ->join('users', 'cc_id', '=', 'users.id')
                ->where('users.user_id', 'LIKE', "%{$request->cc}%")
                ->orWhere('users.name', 'LIKE', "%{$request->cc}%")
                ->get();
        } else if ($request->has('title') && $request->title != "" && $request->has('code') && $request->code != "") {
            $courses = Course::sortable()
                ->where('title', 'LIKE', "%{$request->title}%")
                ->where('code', 'LIKE', "%{$request->code}%")
                ->get();
        } else if ($request->has('title') && $request->title != "" && $request->has('cc') && $request->cc != "") {
            $courses = Course::sortable()
                ->join('users', 'cc_id', '=', 'users.id')
                ->where('title', 'LIKE', "%{$request->title}%")
                ->where('users.user_id', 'LIKE', "%{$request->cc}%")
                ->orWhere('users.name', 'LIKE', "%{$request->cc}%")
                ->get();
        } else if ($request->has('code') && $request->code != "" && $request->has('cc') && $request->cc != "") {
            $courses = Course::sortable()
                ->join('users', 'cc_id', '=', 'users.id')
                ->where('code', 'LIKE', "%{$request->code}%")
                ->where('users.user_id', 'LIKE', "%{$request->cc}%")
                ->orWhere('users.name', 'LIKE', "%{$request->cc}%")
                ->get();
        } else if ($request->has('title') && $request->title != "" && $request->has('code') && $request->code != "" && $request->has('cc') && $request->cc != "") {
            $courses = Course::sortable()
                ->join('users', 'cc_id', '=', 'users.id')
                ->where('title', 'LIKE', "%{$request->title}%")
                ->where('code', 'LIKE', "%{$request->code}%")
                ->where('users.user_id', 'LIKE', "%{$request->cc}%")
                ->orWhere('users.name', 'LIKE', "%{$request->cc}%")
                ->get();
        } else {
            $courses = Course::sortable()->get();
        }

        $users = DB::table('users')->get();
        return view('pages.admin.course.index', ['courses' => $courses, 'users' => $users]);
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
            'code' => 'required',
            'title' => 'required',
            'cc_id' => 'required'
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
        if ($request->has('keyword') && $request->keyword != "") {
            $assigned_lecturers = DB::table('course_assigned')
                ->join('users', 'lecturer_id', '=', 'users.id')
                ->select('users.id as id', 'users.user_id as user_id', 'users.name as name')
                ->where('course_assigned.course_id', '=', $course->id)
                ->where('users.user_id', 'LIKE', "%{$request->keyword}%")
                ->orWhere('users.name', 'LIKE', "%{$request->keyword}%")
                ->get();
        } else {
            $assigned_lecturers = DB::table('course_assigned')
                ->join('users', 'lecturer_id', '=', 'users.id')
                ->select('users.id as id', 'users.user_id as user_id', 'users.name as name')
                ->where('course_assigned.course_id', '=', $course->id)
                ->get();
        }

        $lecturers = DB::table('users')->where('role', '=', 'Lecturer')->get();
        return view('pages.admin.course.lecturers', ['course' => $course, 'assigned_lecturers' => $assigned_lecturers, 'lecturers' => $lecturers]);
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
        if ($course->delete()) {
            return back()->with('success', 'Course deleted successfully!');
        }
        return back()->with('error', "Course cannot not deleted.");
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

        $status = DB::table('course_assigned')->insert([
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
        $status = DB::table('course_assigned')
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
