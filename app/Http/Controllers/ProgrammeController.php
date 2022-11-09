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
            'type' => 'required',
            'code' => 'required',
            'title' => 'required'
        ]);

        $programme = new Programme;
        $programme->type = $request->type;
        $programme->code = $request->code;
        $programme->title = $request->title;

        if ($programme->save()) {
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
        $courses = DB::table('course')->get();
        return view('pages.admin.programme.show', ['programme' => $programme, 'courses' => $courses]);
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
