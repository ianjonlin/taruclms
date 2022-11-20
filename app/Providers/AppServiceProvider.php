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

            if (auth()->check()) {
                // For students
                if (auth()->user()->role == "Student") {
                    $programme_id = auth()->user()->programme;

                    $programme_structure_y1_s1 = DB::table('programme_structure')
                        ->join('course', 'course_id', '=', 'course.id')
                        ->select('course.code as code', 'course.title as title')
                        ->where([
                            ['programme_id', '=', $programme_id],
                            ['year', '=', 1],
                            ['sem', '=', 1]
                        ])->get();
                    $programme_structure_y1_s2 = DB::table('programme_structure')
                        ->join('course', 'course_id', '=', 'course.id')
                        ->select('course.code as code', 'course.title as title')
                        ->where([
                            ['programme_id', '=', $programme_id],
                            ['year', '=', 1],
                            ['sem', '=', 2]
                        ])->get();
                    $programme_structure_y1_s3 = DB::table('programme_structure')
                        ->join('course', 'course_id', '=', 'course.id')
                        ->select('course.code as code', 'course.title as title')
                        ->where([
                            ['programme_id', '=', $programme_id],
                            ['year', '=', 1],
                            ['sem', '=', 3]
                        ])->get();

                    $programme_structure_y2_s1 = DB::table('programme_structure')
                        ->join('course', 'course_id', '=', 'course.id')
                        ->select('course.code as code', 'course.title as title')
                        ->where([
                            ['programme_id', '=', $programme_id],
                            ['year', '=', 2],
                            ['sem', '=', 1]
                        ])->get();
                    $programme_structure_y2_s2 = DB::table('programme_structure')
                        ->join('course', 'course_id', '=', 'course.id')
                        ->select('course.code as code', 'course.title as title')
                        ->where([
                            ['programme_id', '=', $programme_id],
                            ['year', '=', 2],
                            ['sem', '=', 2]
                        ])->get();
                    $programme_structure_y2_s3 = DB::table('programme_structure')
                        ->join('course', 'course_id', '=', 'course.id')
                        ->select('course.code as code', 'course.title as title')
                        ->where([
                            ['programme_id', '=', $programme_id],
                            ['year', '=', 2],
                            ['sem', '=', 3]
                        ])->get();

                    $programme_structure_y3_s1 = DB::table('programme_structure')
                        ->join('course', 'course_id', '=', 'course.id')
                        ->select('course.code as code', 'course.title as title')
                        ->where([
                            ['programme_id', '=', $programme_id],
                            ['year', '=', 3],
                            ['sem', '=', 1]
                        ])->get();
                    $programme_structure_y3_s2 = DB::table('programme_structure')
                        ->join('course', 'course_id', '=', 'course.id')
                        ->select('course.code as code', 'course.title as title')
                        ->where([
                            ['programme_id', '=', $programme_id],
                            ['year', '=', 3],
                            ['sem', '=', 2]
                        ])->get();
                    $programme_structure_y3_s3 = DB::table('programme_structure')
                        ->join('course', 'course_id', '=', 'course.id')
                        ->select('course.code as code', 'course.title as title')
                        ->where([
                            ['programme_id', '=', $programme_id],
                            ['year', '=', 3],
                            ['sem', '=', 3]
                        ])->get();

                    $programme_structure_y4_s1 = DB::table('programme_structure')
                        ->join('course', 'course_id', '=', 'course.id')
                        ->select('course.code as code', 'course.title as title')
                        ->where([
                            ['programme_id', '=', $programme_id],
                            ['year', '=', 4],
                            ['sem', '=', 1]
                        ])->get();
                    $programme_structure_y4_s2 = DB::table('programme_structure')
                        ->join('course', 'course_id', '=', 'course.id')
                        ->select('course.code as code', 'course.title as title')
                        ->where([
                            ['programme_id', '=', $programme_id],
                            ['year', '=', 4],
                            ['sem', '=', 2]
                        ])->get();
                    $programme_structure_y4_s3 = DB::table('programme_structure')
                        ->join('course', 'course_id', '=', 'course.id')
                        ->select('course.code as code', 'course.title as title')
                        ->where([
                            ['programme_id', '=', $programme_id],
                            ['year', '=', 4],
                            ['sem', '=', 3]
                        ])->get();

                    view()->share([
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
                    ]);
                }

                // For lecturers - assigned courses / CC
                else if (auth()->user()->role == "Lecturer") {

                    // Check if lecturer is CC of any course
                    $check_cc = DB::table('course')
                        ->where('cc_id', '=', auth()->user()->id)
                        ->get();

                    // If not cc, get assigned course(s)
                    if (!$check_cc->isEmpty()) {
                        $assigned_courses = $check_cc;
                    } else {
                        $assigned_courses = DB::table('assigned_course')
                            ->join('course', 'course_id', '=', 'course.id')
                            ->select('course_id as id', 'course.code as code', 'course.title as title')
                            ->where('lecturer_id', '=', auth()->user()->id)
                            ->get();
                    }

                    view()->share('assigned_courses', $assigned_courses);
                }
            }
        });
    }
}
