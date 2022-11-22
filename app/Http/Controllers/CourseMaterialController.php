<?php

namespace App\Http\Controllers;

use App\Models\CourseMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
            'file' => 'required | mimes:doc,docx,xls,xlsx,ppt,pptx,pdf,jpg,jpeg,png,gif,txt | max:100000'
        ]);

        $category = DB::table('cm_category')->where('id', '=', $request->category)->get()->first();
        $path = Storage::putFileAs('uploads/coursematerials/' . $courseCode . '/' . $category->name, $request->file('file'), $request->name . "." . $request->file('file')->getClientOriginalExtension());

        $status = DB::table('course_material')->insert([
            'name' => $request->name,
            'category_id' => $request->category,
            'path' => $path,
            'ext' => $request->file('file')->extension()
        ]);

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

    /**
     * Download Course Material
     *
     */
    public function downloadCourseMaterial($courseCode, $id)
    {
        $material = DB::table('course_material')
            ->where('id', '=', $id)
            ->get()
            ->first();

        return Storage::download($material->path);
    }
}
