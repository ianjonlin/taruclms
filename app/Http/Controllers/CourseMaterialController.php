<?php

namespace App\Http\Controllers;

use App\Models\CourseMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseMaterialController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(CourseMaterial::class, 'courseMaterial');
    }

    /**
     * Redirect to Create Page
     *
     */
    public function createCourseMaterial($courseCode)
    {
        $course = DB::table('course')->where('code', '=', $courseCode)->get()->first();
        $categories = DB::table('cm_category')
            ->where('course_id', '=', $course->id)
            ->get();

        return view('pages.user.cm.create', ['courseCode' => $courseCode, 'categories' => $categories]);
    }

    /**
     * Store New Course Material
     *
     */
    public function storeCourseMaterial($courseCode, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'file' => 'required | mimes:doc,docx,xls,xlsx,ppt,pptx,pdf,jpg,jpeg,png,gif,txt | max: 102400'
        ]);

        $path = '/storage/' . $request->file('file')->storeAs('uploads/coursematerials/' . $courseCode, time() . '_' . $request->name . "." . $request->file('file')->getClientOriginalExtension(), 'public');
        $ext = $request->file('file')->extension();
        $size = $request->file('file')->getSize();

        $status = DB::table('course_material')->insert([
            'name' => $request->name,
            'category_id' => $request->category,
            'path' => $path,
            'ext' => $ext,
            'size' => $size
        ]);

        // Schema::create('course_material', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('category_id')->references('id')->on('cm_category');
        //     $table->string('name', 256);
        //     $table->string('path', 256);
        //     $table->string('ext', 5);
        //     $table->float('size');
        // });

        if ($status) {
            return redirect()->route('viewCMCategory', ['courseCode' => $courseCode])->with('success', 'Course Material uploaded successfully!');
        } else {
            return redirect()->route('viewCMCategory', ['courseCode' => $courseCode])->with('error', 'Course Material cannot be uploaded.');
        }
    }

    /**
     * Delete Course Material
     *
     */
    public function deleteCourseMaterial($courseCode, $id, Request $request)
    {
        $status = DB::table('course_material')->where('id', '=', $id)->delete();

        if ($status) {
            return back()->with('success', 'Course Material deleted successfully!');
        } else {
            return back()->with('error', "Course Material cannot not deleted.");
        }
    }
}
