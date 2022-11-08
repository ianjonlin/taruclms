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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::sortable()->paginate(5);
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
        $courses = DB::table('course')->get();
        $users = DB::table('users')->get();
        return view('pages.admin.course.create', ['courses' => $courses, 'users' => $users]);
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
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        $courses = DB::table('course')->get();
        $users = DB::table('users')->get();
        return view('pages.admin.course.edit', ['course' => $course, 'courses' => $courses, 'users' => $users]);
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
}
