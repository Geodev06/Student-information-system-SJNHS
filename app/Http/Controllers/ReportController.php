<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    function __construct()
    {
        $this->middleware(['auth', 'isAdmin']);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $male = Record::where('school_year', $request->school_year)
                ->where('sex', 0)->count();

            $female = Record::where('school_year', $request->school_year)
                ->where('sex', 1)->count();

            $records = Record::select('school_year', 'data')
                ->where('school_year', $request->school_year)
                ->groupBy('school_year', 'data', 'gen_ave')
                ->get();

            $grade_7 = Record::where('classified_grade', 7)->where('school_year', $request->school_year)->count();
            $grade_8 = Record::where('classified_grade', 8)->where('school_year', $request->school_year)->count();
            $grade_9 = Record::where('classified_grade', 9)->where('school_year', $request->school_year)->count();
            $grade_10 = Record::where('classified_grade', 10)->where('school_year', $request->school_year)->count();
            $grade_11 = Record::where('classified_grade', 11)->where('school_year', $request->school_year)->count();
            $grade_12 = Record::where('classified_grade', 12)->where('school_year', $request->school_year)->count();


            $grade_7_grades = Record::select(
                DB::raw('min(gen_ave) as min_grade'),
                DB::raw('avg(gen_ave) as avg_grade'),
                DB::raw('max(gen_ave) as max_grade')
            )->where('classified_grade', 7)
                ->where('school_year', $request->school_year)
                ->get();
            $grade_8_grades = Record::select(
                DB::raw('min(gen_ave) as min_grade'),
                DB::raw('avg(gen_ave) as avg_grade'),
                DB::raw('max(gen_ave) as max_grade')
            )->where('classified_grade', 8)
                ->where('school_year', $request->school_year)
                ->get();
            $grade_9_grades = Record::select(
                DB::raw('min(gen_ave) as min_grade'),
                DB::raw('avg(gen_ave) as avg_grade'),
                DB::raw('max(gen_ave) as max_grade')
            )->where('classified_grade', 9)
                ->where('school_year', $request->school_year)
                ->get();
            $grade_10_grades = Record::select(
                DB::raw('min(gen_ave) as min_grade'),
                DB::raw('avg(gen_ave) as avg_grade'),
                DB::raw('max(gen_ave) as max_grade')
            )->where('classified_grade', 10)
                ->where('school_year', $request->school_year)
                ->get();
            $grade_11_grades = Record::select(
                DB::raw('min(gen_ave) as min_grade'),
                DB::raw('avg(gen_ave) as avg_grade'),
                DB::raw('max(gen_ave) as max_grade')
            )->where('classified_grade', 11)
                ->where('school_year', $request->school_year)
                ->get();
            $grade_12_grades = Record::select(
                DB::raw('min(gen_ave) as min_grade'),
                DB::raw('avg(gen_ave) as avg_grade'),
                DB::raw('max(gen_ave) as max_grade')
            )->where('classified_grade', 12)
                ->where('school_year', $request->school_year)
                ->get();


            $subjects = [];


            for ($i = 0; $i < count($records); $i++) {
                foreach ($records[$i]->data as $data) {
                    foreach ($data as $key => $val) {

                        if (!isset($subjects[$key])) {
                            $subjects[$key] = array();
                        }
                        $subjects[$key][] = $val['final'];
                    }
                }
            }
            return response()->json([
                'status' => 200,
                'data' => $records,
                'gender_count' => ['male' => $male, 'female' => $female],
                'student_count' => [
                    'grade_7' => $grade_7,
                    'grade_8' => $grade_8,
                    'grade_9' => $grade_9,
                    'grade_10' => $grade_10,
                    'grade_11' => $grade_11,
                    'grade_12' => $grade_12,
                ],
                'grade_7_grades' => $grade_7_grades,
                'grade_8_grades' => $grade_8_grades,
                'grade_9_grades' => $grade_9_grades,
                'grade_10_grades' => $grade_10_grades,
                'grade_11_grades' => $grade_11_grades,
                'grade_12_grades' => $grade_12_grades,
                'subjects' => $subjects
            ]);
        }
    }
}
