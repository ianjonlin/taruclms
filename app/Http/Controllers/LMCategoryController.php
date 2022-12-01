<?php

namespace App\Http\Controllers;

use App\Models\LMCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LMCategoryController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(LMCategory::class, 'lmcategory');
    }

    /**
     * View Learning Material Categories
     *
     */
    public function viewLMCategory($courseCode)
    {
        $course = DB::table('course')->where('code', '=', $courseCode)->get()->first();
        if ($course->cc_id != auth()->user()->id)
            abort(403, "Unauthorized Action.");

        $categories = DB::table('lm_category')
            ->where('course_id', '=', $course->id)
            ->get();
        $learningMaterials = DB::table('learning_material')
            ->join('lm_category', 'category_id', '=', 'lm_category.id')
            ->select('learning_material.id as id', 'learning_material.name as name', 'lm_category.id as category', 'learning_material.type as type', 'learning_material.path as path', 'learning_material.ext as ext',)
            ->where('lm_category.course_id', '=', $course->id)
            ->get();

        return view('pages.user.lmcategory.index', ['course' => $course, 'categories' => $categories, 'learningMaterials' => $learningMaterials]);
    }

    /**
     * Redirect to Create Learning Material Category Page
     *
     */
    public function createLMCategory($courseCode)
    {
        $course = DB::table('course')->where('code', '=', $courseCode)->get()->first();
        if ($course->cc_id != auth()->user()->id)
            abort(403, "Unauthorized Action.");
        return view('pages.user.lmcategory.create', ['courseCode' => $courseCode]);
    }

    /**
     * Store New Learning Material Category
     *
     */
    public function storeLMCategory($courseCode, Request $request)
    {
        if ($request->user()->cannot('create', [LMCategory::class, $courseCode])) {
            abort(403, "Unauthorized Action.");
        }

        $request->validate([
            'name' => 'required|unique:lm_category,name'
        ]);

        $course = DB::table('course')->where('code', '=', $courseCode)->get()->first();
        $status = DB::table('lm_category')->insert([
            'course_id' => $course->id,
            'name' => $request->name
        ]);

        if ($status) {
            return redirect()->route('viewLMCategory', ['courseCode' => $courseCode])->with('success', 'Learning Material Category added successfully!');
        } else {
            return redirect()->route('viewLMCategory', ['courseCode' => $courseCode])->with('error', 'Learning Material Category cannot be added.');
        }
    }

    /**
     * Redirect to Edit Learning Material Category Page
     *
     */
    public function editLMCategory($courseCode, $id)
    {
        $course = DB::table('course')->where('code', '=', $courseCode)->get()->first();
        if ($course->cc_id != auth()->user()->id)
            abort(403, "Unauthorized Action.");
        $lMCategory = DB::table('lm_category')->where('id', '=', $id)->get()->first();
        return view('pages.user.lmcategory.edit', ['courseCode' => $courseCode, 'lMCategory' => $lMCategory]);
    }

    /**
     * Update Learning Material Category
     *
     */
    public function updateLMCategory($courseCode, $id, Request $request)
    {
        if ($request->user()->cannot('update', [LMCategory::class, $courseCode])) {
            abort(403, "Unauthorized Action.");
        }

        $request->validate([
            'name' => 'required'
        ]);

        $status = DB::table('lm_category')->where('id', '=', $id)->update(['name' => $request->name]);

        if ($status) {
            return redirect()->route('viewLMCategory', ['courseCode' => $courseCode])->with('success', 'Learning Material Category updated successfully!');
        } else {
            return redirect()->route('viewLMCategory', ['courseCode' => $courseCode])->with('error', 'Learning Material Category cannot be updated.');
        }
    }

    /**
     * Delete Learning Material Category
     *
     */
    public function deleteLMCategory($courseCode, $id, Request $request)
    {
        if ($request->user()->cannot('delete', [LMCategory::class, $courseCode])) {
            abort(403, "Unauthorized Action.");
        }

        $materials = DB::table('learning_material')
            ->join('lm_category', 'learning_material.category_id', '=', 'lm_category.id')
            ->select('learning_material.id as id', 'learning_material.path as path')
            ->where('lm_category.id', '=', $id)
            ->get();
        $category = DB::table('lm_category')->where('id', '=', $id)->get()->first();
        $directoryPath = 'uploads/learningmaterials/' . $courseCode . '/' . $category->name;

        if (Storage::deleteDirectory($directoryPath)) {
            foreach ($materials as $material)
                DB::table('learning_material')->where('id', '=', $material->id)->delete();
            $statusDB = DB::table('lm_category')->where('id', '=', $id)->delete();
        }

        if ($statusDB) {
            return back()->with('success', 'Learning Material Category deleted successfully!');
        } else {
            return back()->with('error', "Learning Material Category cannot not deleted.");
        }
    }
}
