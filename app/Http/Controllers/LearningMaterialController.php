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
            'name' => 'required|unique:learning_material,name',
            'category' => 'required',
            'file' => 'mimes:doc,docx,xls,xlsx,ppt,pptx,pdf,jpg,jpeg,png,gif,txt | max:100000',
            'url' => 'nullable | url'
        ]);

        if ($request->file && $request->url) {
            return back()->withErrors('Either a file upload OR a Web URL Link is accepted.');
        } else if (!$request->file && !$request->url) {
            return back()->withErrors('A file upload OR a Web URL Link is required.');
        }

        $category = DB::table('lm_category')->where('id', '=', $request->category)->get()->first();

        if ($request->file) {
            $type = 'file';
            $path = Storage::putFileAs('uploads/learningmaterials/' . $courseCode . '/' . $category->name, $request->file('file'), $request->name . "." . $request->file('file')->getClientOriginalExtension());
            $ext = $request->file('file')->extension();
        } else if ($request->url) {
            $type = 'url';
            $path = $request->url;
            $ext = null;
        }


        $status = DB::table('learning_material')->insert([
            'name' => $request->name,
            'category_id' => $request->category,
            'type' => $type,
            'path' => $path,
            'ext' => $ext
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

        if ($material->type == "file") {
            if (Storage::delete($material->path))
                $status = DB::table('learning_material')->where('id', '=', $material->id)->delete();
        } else if ($material->type == "url") {
            $status = DB::table('learning_material')->where('id', '=', $material->id)->delete();
        }

        if ($status) {
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
