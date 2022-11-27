<?php

namespace App\Http\Controllers;

use App\Models\LearningMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LearningMaterialController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(LearningMaterial::class, 'learningMaterial');
    }

    /**
     * Redirect to Create Learning Material Page
     *
     */
    public function createLearningMaterial($courseCode)
    {
        $course = DB::table('course')->where('code', '=', $courseCode)->get()->first();
        if ($course->cc_id != auth()->user()->id)
            abort(403, "Unauthorized Action.");

        $categories = DB::table('lm_category')
            ->where('course_id', '=', $course->id)
            ->get();

        return view('pages.user.lm.create', ['courseCode' => $courseCode, 'categories' => $categories]);
    }

    /**
     * Store New Learning Material
     *
     */
    public function storeLearningMaterial($courseCode, Request $request)
    {
        if ($request->user()->cannot('create', [LearningMaterial::class, $courseCode])) {
            abort(403, "Unauthorized Action.");
        }

        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'file' => 'required | mimes:doc,docx,xls,xlsx,ppt,pptx,pdf,jpg,jpeg,png,gif,txt | max:100000'
        ]);

        $category = DB::table('lm_category')->where('id', '=', $request->category)->get()->first();
        $path = Storage::putFileAs('uploads/learningmaterials/' . $courseCode . '/' . $category->name, $request->file('file'), $request->name . "." . $request->file('file')->getClientOriginalExtension());

        $status = DB::table('learning_material')->insert([
            'name' => $request->name,
            'category_id' => $request->category,
            'path' => $path,
            'ext' => $request->file('file')->extension()
        ]);

        if ($status) {
            return redirect()->route('viewLMCategory', ['courseCode' => $courseCode])->with('success', 'Learning Material uploaded successfully!');
        } else {
            return redirect()->route('viewLMCategory', ['courseCode' => $courseCode])->with('error', 'Learning Material cannot be uploaded.');
        }
    }

    /**
     * Delete Learning Material
     *
     */
    public function deleteLearningMaterial($courseCode, $id, Request $request)
    {
        if ($request->user()->cannot('delete', [LearningMaterial::class, $courseCode])) {
            abort(403, "Unauthorized Action.");
        }

        $material = DB::table('learning_material')
            ->where('id', '=', $id)
            ->get()
            ->first();

        $statusDB = DB::table('learning_material')->where('id', '=', $id)->delete();
        $statusFile = Storage::delete($material->path);

        if ($statusDB && $statusFile) {
            return back()->with('success', 'Learning Material deleted successfully!');
        } else {
            return back()->with('error', "Learning Material cannot not deleted.");
        }
    }

    /**
     * Download Learning Material
     *
     */
    public function downloadLearningMaterial($courseCode, $id)
    {
        $material = DB::table('learning_material')
            ->where('id', '=', $id)
            ->get()
            ->first();

        return Storage::download($material->path);
    }
}
