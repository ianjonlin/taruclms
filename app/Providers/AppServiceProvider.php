<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Global Data - View Composer
        view()->composer('*', function ($view) {

            $isCC = false;

            if (auth()->check()) {
                // For students
                if (auth()->user()->role == "Student") {
                    $programme = DB::table('programme')
                        ->where('id', '=', auth()->user()->programme)
                        ->get()->first();

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

                            array_push($programme_structure, [$p, $year, $sem]);
                        }
                    }

                    view()->share([
                        'programmeYear' => $programmeYear,
                        'programme_structure' => $programme_structure
                    ]);
                }

                // For lecturers - assigned courses / CC
                else if (auth()->user()->role == "Lecturer") {

                    // Check if lecturer is CC of any course
                    $check_cc = DB::table('course')
                        ->where('cc_id', '=', auth()->user()->id)
                        ->get();

                    // If not CC, get assigned course(s)
                    if (!$check_cc->isEmpty()) {
                        $assigned_courses = $check_cc;
                        $isCC = true;
                    } else {
                        $assigned_courses = DB::table('assigned_course')
                            ->join('course', 'course_id', '=', 'course.id')
                            ->select('course_id as id', 'course.code as code', 'course.title as title')
                            ->where('lecturer_id', '=', auth()->user()->id)
                            ->get();
                        $isCC = false;
                    }

                    view()->share('assigned_courses', $assigned_courses);
                }

                view()->share('isCC', $isCC);
            }
        });
    }
}
