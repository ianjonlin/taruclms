<?php

namespace App\Http\Controllers;

use App\Models\CMCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CMCategoryController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(CMCategory::class, 'cmcategory');
    }

    /**
     * View categories
     *
     */
    public function viewCMCategory($courseCode)
    {
        $course = DB::table('course')->where('code', '=', $courseCode)->get()->first();
        $categories = DB::table('cm_category')
            ->where('course_id', '=', $course->id)
            ->get();

        return view('pages.user.cmcategory.index', ['categories' => $categories, 'course' => $course]);
    }

    /**
     * Redirect to Create Page
     *
     */
    public function createCMCategory($courseCode)
    {
        return view('pages.user.cmcategory.create', ['courseCode' => $courseCode]);
    }

    /**
     * Store New Category
     *
     */
    public function storeCMCategory($courseCode, Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $course = DB::table('course')->where('code', '=', $courseCode)->get()->first();
        $status = DB::table('cm_category')->insert([
            'course_id' => $course->id,
            'name' => $request->name
        ]);

        if ($status) {
            return redirect()->route('viewCMCategory', ['courseCode' => $courseCode])->with('success', 'Course Material Category added successfully!');
        } else {
            return redirect()->route('viewCMCategory', ['courseCode' => $courseCode])->with('error', 'Course Material Category cannot be added.');
        }
    }

    /**
     * Redirect to Edit Page
     *
     */
    public function editCMCategory($courseCode, $id)
    {
        $cMCategory = DB::table('cm_category')->where('id', '=', $id)->get()->first();
        return view('pages.user.cmcategory.edit', ['courseCode' => $courseCode, 'cMCategory' => $cMCategory]);
    }

    /**
     * Update Category
     *
     */
    public function updateCMCategory($courseCode, $id, Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $status = DB::table('cm_category')->where('id', '=', $id)->update(['name' => $request->name]);

        if ($status) {
            return redirect()->route('viewCMCategory', ['courseCode' => $courseCode])->with('success', 'Course Material Category updated successfully!');
        } else {
            return redirect()->route('viewCMCategory', ['courseCode' => $courseCode])->with('error', 'Course Material Category cannot be updated.');
        }
    }

    /**
     * Delete Category
     *
     */
    public function deleteCMCategory($courseCode, $id, Request $request)
    {
        $status = DB::table('cm_category')->where('id', '=', $id)->delete();

        if ($status) {
            return back()->with('success', 'Course Material Category deleted successfully!');
        } else {
            return back()->with('error', "Course Material Category cannot not deleted.");
        }
    }
}
