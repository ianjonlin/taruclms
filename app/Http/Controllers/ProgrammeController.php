<?php

namespace App\Http\Controllers;

use App\Models\Programme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgrammeController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(Programme::class, 'programme');
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
        $search_type = null;

        if ($request->get('title') != null)
            $search_title = $request->title;
        if ($request->get('code') != null)
            $search_code = $request->code;
        if ($request->has('type'))
            $search_type = $request->type;

        if ($request->get('title') != null && $request->get('code') != null && $request->has('type')) {
            $programmes = Programme::sortable()
                ->where('code', 'LIKE', "%{$search_code}%")
                ->where('title', 'LIKE', "%{$search_title}%")
                ->where('type', '=', $search_type)
                ->get();
        } else if ($request->get('title') != null && $request->get('code') != null) {
            $programmes = Programme::sortable()
                ->where('code', 'LIKE', "%{$search_code}%")
                ->where('title', 'LIKE', "%{$search_title}%")
                ->get();
        } else if ($request->get('code') != null && $request->has('type')) {
            $programmes = Programme::sortable()
                ->where('code', 'LIKE', "%{$search_code}%")
                ->where('type', '=', $search_type)
                ->get();
        } else if ($request->get('title') != null && $request->has('type')) {
            $programmes = Programme::sortable()
                ->where('title', 'LIKE', "%{$search_title}%")
                ->where('type', '=', $search_type)
                ->get();
        } else if ($request->get('code') != null) {
            $programmes = Programme::sortable()
                ->where('code', 'LIKE', "%{$search_code}%")
                ->get();
        } else if ($request->get('title') != null) {
            $programmes = Programme::sortable()
                ->where('title', 'LIKE', "%{$search_title}%")
                ->get();
        } else if ($request->has('type')) {
            $programmes = Programme::sortable()
                ->where('type', '=', $search_type)
                ->get();
        } else {
            $programmes = Programme::sortable()->get();
        }

        $types = array('Foundation Programme', 'Diploma', 'Bachelor Degree', 'Master', 'Doctor of Philosophy');

        return view('pages.admin.programme.index', ['programmes' => $programmes, 'types' => $types, 'search_code' => $search_code, 'search_title' => $search_title, 'search_type' => $search_type]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = array('Foundation Programme', 'Diploma', 'Bachelor Degree', 'Master', 'Doctor of Philosophy');
        $courses = DB::table('course')->get();
        return view('pages.admin.programme.create', ['types' => $types, 'courses' => $courses]);
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
            'code' => 'required|unique:programme,code',
            'title' => 'required',
        ]);

        $programme = new Programme;
        $programme->type = $request->hiddenType;
        $programme->code = $request->code;
        $programme->title = $request->title;

        // Array = courses, year, sem
        $programme_structure = [];

        if (!in_array(null, $request->y1s1c))
            array_push($programme_structure, [$request->y1s1c, 1, 1]);
        if (!in_array(null, $request->y1s2c))
            array_push($programme_structure, [$request->y1s2c, 1, 2]);
        if (!in_array(null, $request->y1s3c))
            array_push($programme_structure, [$request->y1s3c, 1, 3]);

        switch ($programme->type) {
            case "Foundation Programme":
                break;
            case "Diploma":

                if (!in_array(null, $request->y2s1c))
                    array_push($programme_structure, [$request->y2s1c, 2, 1]);
                if (!in_array(null, $request->y2s2c))
                    array_push($programme_structure, [$request->y2s2c, 2, 2]);
                if (!in_array(null, $request->y2s3c))
                    array_push($programme_structure, [$request->y2s3c, 2, 3]);

                break;
            case "Bachelor Degree":

                if (!in_array(null, $request->y2s1c))
                    array_push($programme_structure, [$request->y2s1c, 2, 1]);
                if (!in_array(null, $request->y2s2c))
                    array_push($programme_structure, [$request->y2s2c, 2, 2]);
                if (!in_array(null, $request->y2s3c))
                    array_push($programme_structure, [$request->y2s3c, 2, 3]);

                if (!in_array(null, $request->y3s1c))
                    array_push($programme_structure, [$request->y3s1c, 3, 1]);
                if (!in_array(null, $request->y3s2c))
                    array_push($programme_structure, [$request->y3s2c, 3, 2]);
                if (!in_array(null, $request->y3s3c))
                    array_push($programme_structure, [$request->y3s3c, 3, 3]);

                break;
            case "Master":

                if (!in_array(null, $request->y2s1c))
                    array_push($programme_structure, [$request->y2s1c, 2, 1]);
                if (!in_array(null, $request->y2s2c))
                    array_push($programme_structure, [$request->y2s2c, 2, 2]);
                if (!in_array(null, $request->y2s3c))
                    array_push($programme_structure, [$request->y2s3c, 2, 3]);

                break;
            case "Doctor of Philosophy":

                if (!in_array(null, $request->y2s1c))
                    array_push($programme_structure, [$request->y2s1c, 2, 1]);
                if (!in_array(null, $request->y2s2c))
                    array_push($programme_structure, [$request->y2s2c, 2, 2]);
                if (!in_array(null, $request->y2s3c))
                    array_push($programme_structure, [$request->y2s3c, 2, 3]);

                if (!in_array(null, $request->y3s1c))
                    array_push($programme_structure, [$request->y3s1c, 3, 1]);
                if (!in_array(null, $request->y3s2c))
                    array_push($programme_structure, [$request->y3s2c, 3, 2]);
                if (!in_array(null, $request->y3s3c))
                    array_push($programme_structure, [$request->y3s3c, 3, 3]);

                if (!in_array(null, $request->y4s1c))
                    array_push($programme_structure, [$request->y4s1c, 4, 1]);
                if (!in_array(null, $request->y4s2c))
                    array_push($programme_structure, [$request->y4s2c, 4, 2]);
                if (!in_array(null, $request->y4s3c))
                    array_push($programme_structure, [$request->y4s3c, 4, 3]);

                break;
        }

        if ($programme->save()) {
            foreach ($programme_structure as $structure) {
                foreach ($structure[0] as $course) {
                    DB::table('programme_structure')->insert([
                        ['programme_id' => $programme->id, 'course_id' => $course, 'year' => $structure[1], 'sem' => $structure[2]]
                    ]);
                }
            }
            return redirect()->route('programme.index')->with('success', 'Programme created successfully!');
        } else {
            return redirect()->route('programme.index')->with('error', 'Programme cannot be created.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Programme  $programme
     * @return \Illuminate\Http\Response
     */
    public function show(Programme $programme)
    {
        switch ($programme->type) {
            case "Foundation Programme":
                $programmeYear = 1;
                break;
            case "Diploma":
                $programmeYear = 2;
                break;
            case "Bachelor Degree":
                $programmeYear = 3;
                break;
            case "Master":
                $programmeYear = 2;
                break;
            case "Doctor of Philosophy":
                $programmeYear = 4;
                break;
        }

        $programme_structure = [];

        for ($year = 1; $year < $programmeYear + 1; $year++) {
            for ($sem = 1; $sem < 4; $sem++) {
                $p = DB::table('programme_structure')
                    ->join('course', 'course_id', '=', 'course.id')
                    ->select('course.code as code', 'course.title as title')
                    ->where([
                        ['programme_id', '=', $programme->id],
                        ['year', '=', $year],
                        ['sem', '=', $sem]
                    ])->get();

                array_push($programme_structure, $p);
            }
        }

        return view(
            'pages.admin.programme.show',
            [
                'programme' => $programme,
                'programmeYear' => $programmeYear,
                'programme_structure' => $programme_structure
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Programme $programme)
    {
        switch ($programme->type) {
            case "Foundation Programme":
                $programmeYear = 1;
                break;
            case "Diploma":
                $programmeYear = 2;
                break;
            case "Bachelor Degree":
                $programmeYear = 3;
                break;
            case "Master":
                $programmeYear = 2;
                break;
            case "Doctor of Philosophy":
                $programmeYear = 4;
                break;
        }

        $courses = DB::table('course')->get();

        $programme_structure = [];

        for ($year = 1; $year < $programmeYear + 1; $year++) {
            for ($sem = 1; $sem < 4; $sem++) {
                $p = DB::table('programme_structure')
                    ->join('course', 'course_id', '=', 'course.id')
                    ->select('course.id as id', 'course.code as code', 'course.title as title')
                    ->where([
                        ['programme_id', '=', $programme->id],
                        ['year', '=', $year],
                        ['sem', '=', $sem]
                    ])->get();

                array_push($programme_structure, $p);
            }
        }

        return view('pages.admin.programme.edit', [
            'programme' => $programme,
            'programmeYear' => $programmeYear,
            'courses' => $courses,
            'programme_structure' => $programme_structure
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Programme  $programme
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Programme $programme)
    {
        $request->validate([
            'code' => 'required',
            'title' => 'required'
        ]);

        $programme->code = $request->code;
        $programme->title = $request->title;

        // Array = courses, year, sem
        $programme_structure = [];

        if (!in_array(null, $request->y1s1c))
            array_push($programme_structure, [$request->y1s1c, 1, 1]);
        if (!in_array(null, $request->y1s2c))
            array_push($programme_structure, [$request->y1s2c, 1, 2]);
        if (!in_array(null, $request->y1s3c))
            array_push($programme_structure, [$request->y1s3c, 1, 3]);

        switch ($programme->type) {
            case "Foundation Programme":
                break;
            case "Diploma":

                if (!in_array(null, $request->y2s1c))
                    array_push($programme_structure, [$request->y2s1c, 2, 1]);
                if (!in_array(null, $request->y2s2c))
                    array_push($programme_structure, [$request->y2s2c, 2, 2]);
                if (!in_array(null, $request->y2s3c))
                    array_push($programme_structure, [$request->y2s3c, 2, 3]);

                break;
            case "Bachelor Degree":

                if (!in_array(null, $request->y2s1c))
                    array_push($programme_structure, [$request->y2s1c, 2, 1]);
                if (!in_array(null, $request->y2s2c))
                    array_push($programme_structure, [$request->y2s2c, 2, 2]);
                if (!in_array(null, $request->y2s3c))
                    array_push($programme_structure, [$request->y2s3c, 2, 3]);

                if (!in_array(null, $request->y3s1c))
                    array_push($programme_structure, [$request->y3s1c, 3, 1]);
                if (!in_array(null, $request->y3s2c))
                    array_push($programme_structure, [$request->y3s2c, 3, 2]);
                if (!in_array(null, $request->y3s3c))
                    array_push($programme_structure, [$request->y3s3c, 3, 3]);

                break;
            case "Master":

                if (!in_array(null, $request->y2s1c))
                    array_push($programme_structure, [$request->y2s1c, 2, 1]);
                if (!in_array(null, $request->y2s2c))
                    array_push($programme_structure, [$request->y2s2c, 2, 2]);
                if (!in_array(null, $request->y2s3c))
                    array_push($programme_structure, [$request->y2s3c, 2, 3]);

                break;
            case "Doctor of Philosophy":

                if (!in_array(null, $request->y2s1c))
                    array_push($programme_structure, [$request->y2s1c, 2, 1]);
                if (!in_array(null, $request->y2s2c))
                    array_push($programme_structure, [$request->y2s2c, 2, 2]);
                if (!in_array(null, $request->y2s3c))
                    array_push($programme_structure, [$request->y2s3c, 2, 3]);

                if (!in_array(null, $request->y3s1c))
                    array_push($programme_structure, [$request->y3s1c, 3, 1]);
                if (!in_array(null, $request->y3s2c))
                    array_push($programme_structure, [$request->y3s2c, 3, 2]);
                if (!in_array(null, $request->y3s3c))
                    array_push($programme_structure, [$request->y3s3c, 3, 3]);

                if (!in_array(null, $request->y4s1c))
                    array_push($programme_structure, [$request->y4s1c, 4, 1]);
                if (!in_array(null, $request->y4s2c))
                    array_push($programme_structure, [$request->y4s2c, 4, 2]);
                if (!in_array(null, $request->y4s3c))
                    array_push($programme_structure, [$request->y4s3c, 4, 3]);

                break;
        }

        if ($programme->save()) {

            // Delete current ps and insert new one
            $status = DB::table('programme_structure')
                ->where('programme_id', '=', $programme->id)
                ->delete();

            if ($status) {
                foreach ($programme_structure as $structure) {
                    foreach ($structure[0] as $course) {
                        DB::table('programme_structure')->insert([
                            ['programme_id' => $programme->id, 'course_id' => $course, 'year' => $structure[1], 'sem' => $structure[2]]
                        ]);
                    }
                }
            }
            return redirect()->route('programme.index')->with('success', 'Programme updated successfully!');
        } else {
            return redirect()->route('programme.index')->with('error', 'Programme cannot be updated.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Programme  $programme
     * @return \Illuminate\Http\Response
     */
    public function destroy(Programme $programme)
    {
        DB::table('users')
            ->where('programme', '=', $programme->id)
            ->update(['programme' => null]);

        DB::table('programme_structure')
            ->where('programme_id', '=', $programme->id)
            ->delete();

        if ($programme->delete()) {
            return back()->with('success', 'Programme deleted successfully!');
        }
        return back()->with('error', "Programme cannot not deleted.");
    }
}
