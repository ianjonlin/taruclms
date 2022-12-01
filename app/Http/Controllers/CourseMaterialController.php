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
     * Redirect to Create Course Material Page
     *
     */
    public function createCourseMaterial($courseCode)
    {
        $course = DB::table('course')->where('code', '=', $courseCode)->get()->first();
        if ($course->cc_id != auth()->user()->id)
            abort(403, "Unauthorized Action.");

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
        if ($request->user()->cannot('create', [CourseMaterial::class, $courseCode])) {
            abort(403, "Unauthorized Action.");
        }

        $request->validate([
            'name' => 'required|unique:course_material,name',
            'category' => 'required',
            'file' => 'mimes:doc,docx,xls,xlsx,ppt,pptx,pdf,jpg,jpeg,png,gif,txt | max:100000',
            'url' => 'nullable | url'
        ]);

        if ($request->file && $request->url) {
            return back()->withErrors('Either a file upload OR a Web URL Link is accepted.');
        } else if (!$request->file && !$request->url) {
            return back()->withErrors('A file upload OR a Web URL Link is required.');
        }

        $category = DB::table('cm_category')->where('id', '=', $request->category)->get()->first();
        if ($request->file) {
            $type = 'file';
            $path = Storage::putFileAs('uploads/coursematerials/' . $courseCode . '/' . $category->name, $request->file('file'), $request->name . "." . $request->file('file')->getClientOriginalExtension());
            $ext = $request->file('file')->extension();
        } else if ($request->url) {
            $type = 'url';
            $path = $request->url;
            $ext = null;
        }

        $status = DB::table('course_material')->insert([
            'name' => $request->name,
            'category_id' => $request->category,
            'type' => $type,
            'path' => $path,
            'ext' => $ext
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
        if ($request->user()->cannot('delete', [CourseMaterial::class, $courseCode])) {
            abort(403, "Unauthorized Action.");
        }

        $material = DB::table('course_material')
            ->where('id', '=', $id)
            ->get()
            ->first();

        if ($material->type == "file") {
            if (Storage::delete($material->path))
                $status = DB::table('course_material')->where('id', '=', $material->id)->delete();
        } else if ($material->type == "url") {
            $status = DB::table('course_material')->where('id', '=', $material->id)->delete();
        }

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
        if (auth()->user()->role == "Student") {
            abort(403, "Unauthorized Action.");
        }

        $material = DB::table('course_material')
            ->where('id', '=', $id)
            ->get()
            ->first();

        return Storage::download($material->path);
    }
}
