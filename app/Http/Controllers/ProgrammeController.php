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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programmes = Programme::sortable()->paginate(5);
        return view('pages.admin.programme.index', ['programmes' => $programmes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $year = 1;
        $types = array('Foundation Programme', 'Diploma', 'Bachelor Degree', 'Master', 'Doctor of Philosophy');
        $courses = DB::table('course')->get();
        return view('pages.admin.programme.create', ['year' => $year, 'types' => $types, 'courses' => $courses]);
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
            'type' => 'required',
            'code' => 'required',
            'title' => 'required',
        ]);

        $programme = new Programme;
        $programme->type = $request->type;
        $programme->code = $request->code;
        $programme->title = $request->title;

        $structure_array = array(
            array($request->y1s1c1, 1, 1), array($request->y1s1c2, 1, 1), array($request->y1s1c3, 1, 1), array($request->y1s1c4, 1, 1), array($request->y1s1c5, 1, 1), array($request->y1s1c6, 1, 1),
            array($request->y1s2c1, 1, 2), array($request->y1s2c2, 1, 2), array($request->y1s2c3, 1, 2), array($request->y1s2c4, 1, 2), array($request->y1s2c5, 1, 2), array($request->y1s2c6, 1, 2),
            array($request->y1s3c1, 1, 3), array($request->y1s3c2, 1, 3), array($request->y1s3c3, 1, 3), array($request->y1s3c4, 1, 3), array($request->y1s3c5, 1, 3), array($request->y1s3c6, 1, 3),

            array($request->y2s1c1, 2, 1), array($request->y2s1c2, 2, 1), array($request->y2s1c3, 2, 1), array($request->y2s1c4, 2, 1), array($request->y2s1c5, 2, 1), array($request->y2s1c6, 2, 1),
            array($request->y2s2c1, 2, 2), array($request->y2s2c2, 2, 2), array($request->y2s2c3, 2, 2), array($request->y2s2c4, 2, 2), array($request->y2s2c5, 2, 2), array($request->y2s2c6, 2, 2),
            array($request->y2s3c1, 2, 3), array($request->y2s3c2, 2, 3), array($request->y2s3c3, 2, 3), array($request->y2s3c4, 2, 3), array($request->y2s3c5, 2, 3), array($request->y2s3c6, 2, 3),

            array($request->y3s1c1, 3, 1), array($request->y3s1c2, 3, 1), array($request->y3s1c3, 3, 1), array($request->y3s1c4, 3, 1), array($request->y3s1c5, 3, 1), array($request->y3s1c6, 3, 1),
            array($request->y3s2c1, 3, 2), array($request->y3s2c2, 3, 2), array($request->y3s2c3, 3, 2), array($request->y3s2c4, 3, 2), array($request->y3s2c5, 3, 2), array($request->y3s2c6, 3, 2),
            array($request->y3s3c1, 3, 3), array($request->y3s3c2, 3, 3), array($request->y3s3c3, 3, 3), array($request->y3s3c4, 3, 3), array($request->y3s3c5, 3, 3), array($request->y3s3c6, 3, 3),

            array($request->y4s1c1, 4, 1), array($request->y4s1c2, 4, 1), array($request->y4s1c3, 4, 1), array($request->y4s1c4, 4, 1), array($request->y4s1c5, 4, 1), array($request->y4s1c6, 4, 1),
            array($request->y4s2c1, 4, 2), array($request->y4s2c2, 4, 2), array($request->y4s2c3, 4, 2), array($request->y4s2c4, 4, 2), array($request->y4s2c5, 4, 2), array($request->y4s2c6, 4, 2),
            array($request->y4s3c1, 4, 3), array($request->y4s3c2, 4, 3), array($request->y4s3c3, 4, 3), array($request->y4s3c4, 4, 3), array($request->y4s3c5, 4, 3), array($request->y4s3c6, 4, 3),
        );

        if ($programme->save()) {

            foreach ($structure_array as $structure) {
                if (!empty($structure[0])) {
                    DB::table('programme_structure')->insert([
                        ['programme_id' => $programme->id, 'course_id' => $structure[0], 'year' => $structure[1], 'sem' => $structure[2]]
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
        $programme_structure_y1_s1 = DB::table('programme_structure')
            ->join('course', 'course_id', '=', 'course.id')
            ->select('course.code as code', 'course.title as title')
            ->where([
                ['programme_id', '=', $programme->id],
                ['year', '=', 1],
                ['sem', '=', 1]
            ])->get();
        $programme_structure_y1_s2 = DB::table('programme_structure')
            ->join('course', 'course_id', '=', 'course.id')
            ->select('course.code as code', 'course.title as title')
            ->where([
                ['programme_id', '=', $programme->id],
                ['year', '=', 1],
                ['sem', '=', 2]
            ])->get();
        $programme_structure_y1_s3 = DB::table('programme_structure')
            ->join('course', 'course_id', '=', 'course.id')
            ->select('course.code as code', 'course.title as title')
            ->where([
                ['programme_id', '=', $programme->id],
                ['year', '=', 1],
                ['sem', '=', 3]
            ])->get();

        $programme_structure_y2_s1 = DB::table('programme_structure')
            ->join('course', 'course_id', '=', 'course.id')
            ->select('course.code as code', 'course.title as title')
            ->where([
                ['programme_id', '=', $programme->id],
                ['year', '=', 2],
                ['sem', '=', 1]
            ])->get();
        $programme_structure_y2_s2 = DB::table('programme_structure')
            ->join('course', 'course_id', '=', 'course.id')
            ->select('course.code as code', 'course.title as title')
            ->where([
                ['programme_id', '=', $programme->id],
                ['year', '=', 2],
                ['sem', '=', 2]
            ])->get();
        $programme_structure_y2_s3 = DB::table('programme_structure')
            ->join('course', 'course_id', '=', 'course.id')
            ->select('course.code as code', 'course.title as title')
            ->where([
                ['programme_id', '=', $programme->id],
                ['year', '=', 2],
                ['sem', '=', 3]
            ])->get();

        $programme_structure_y3_s1 = DB::table('programme_structure')
            ->join('course', 'course_id', '=', 'course.id')
            ->select('course.code as code', 'course.title as title')
            ->where([
                ['programme_id', '=', $programme->id],
                ['year', '=', 3],
                ['sem', '=', 1]
            ])->get();
        $programme_structure_y3_s2 = DB::table('programme_structure')
            ->join('course', 'course_id', '=', 'course.id')
            ->select('course.code as code', 'course.title as title')
            ->where([
                ['programme_id', '=', $programme->id],
                ['year', '=', 3],
                ['sem', '=', 2]
            ])->get();
        $programme_structure_y3_s3 = DB::table('programme_structure')
            ->join('course', 'course_id', '=', 'course.id')
            ->select('course.code as code', 'course.title as title')
            ->where([
                ['programme_id', '=', $programme->id],
                ['year', '=', 3],
                ['sem', '=', 3]
            ])->get();

        $programme_structure_y4_s1 = DB::table('programme_structure')
            ->join('course', 'course_id', '=', 'course.id')
            ->select('course.code as code', 'course.title as title')
            ->where([
                ['programme_id', '=', $programme->id],
                ['year', '=', 4],
                ['sem', '=', 1]
            ])->get();
        $programme_structure_y4_s2 = DB::table('programme_structure')
            ->join('course', 'course_id', '=', 'course.id')
            ->select('course.code as code', 'course.title as title')
            ->where([
                ['programme_id', '=', $programme->id],
                ['year', '=', 4],
                ['sem', '=', 2]
            ])->get();
        $programme_structure_y4_s3 = DB::table('programme_structure')
            ->join('course', 'course_id', '=', 'course.id')
            ->select('course.code as code', 'course.title as title')
            ->where([
                ['programme_id', '=', $programme->id],
                ['year', '=', 4],
                ['sem', '=', 3]
            ])->get();


        return view(
            'pages.admin.programme.show',
            [
                'programme' => $programme,
                'programme_structure_y1_s1' => $programme_structure_y1_s1,
                'programme_structure_y1_s2' => $programme_structure_y1_s2,
                'programme_structure_y1_s3' => $programme_structure_y1_s3,
                'programme_structure_y2_s1' => $programme_structure_y2_s1,
                'programme_structure_y2_s2' => $programme_structure_y2_s2,
                'programme_structure_y2_s3' => $programme_structure_y2_s3,
                'programme_structure_y3_s1' => $programme_structure_y3_s1,
                'programme_structure_y3_s2' => $programme_structure_y3_s2,
                'programme_structure_y3_s3' => $programme_structure_y3_s3,
                'programme_structure_y4_s1' => $programme_structure_y4_s1,
                'programme_structure_y4_s2' => $programme_structure_y4_s2,
                'programme_structure_y4_s3' => $programme_structure_y4_s3
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
        $types = array('Foundation Programme', 'Diploma', 'Bachelor Degree', 'Master', 'Doctor of Philosophy');
        $courses = DB::table('course')->get();
        return view('pages.admin.programme.edit', ['programme' => $programme, 'types' => $types, 'courses' => $courses]);
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

        if ($programme->save()) {
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
        if ($programme->delete()) {
            return back()->with('success', 'Programme deleted successfully!');
        }
        return back()->with('error', "Programme cannot not deleted.");
    }
}
