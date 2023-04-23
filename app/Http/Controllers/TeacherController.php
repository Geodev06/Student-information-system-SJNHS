<?php

namespace App\Http\Controllers;

use App\Models\Otherinformation;
use App\Models\Record;
use App\Models\Section;
use App\Models\SectionStudent;
use App\Models\SectionSubject;
use App\Models\Studentinfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Validator;

class TeacherController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }


    public function show($id)
    {
        $section = Section::where('id', $id)->where('teacher_id', Auth::user()->id)->get();
        if (count($section) > 0) {
            return view('user-teacher.section', compact('section'));
        }
        return abort(404);
    }

    public function index(Request $request, $id)
    {

        if ($request->ajax()) {

            $data = SectionStudent::where('section_id', $id)
                ->select('id', 'lrn', 'fullname', 'section_id')
                ->orderBy('fullname', 'asc')
                ->get();


            return DataTables::of($data)
                ->addColumn('lrn', function ($data) {
                    return $data->lrn;
                })
                ->addColumn('fullname', function ($data) {
                    return $data->fullname;
                })
                ->addColumn('action', function ($data) {
                    $btn = '<a href="' . route('student.showRecord', [$data->lrn, $data->section_id]) . '" class="text-white btn btn-success " data-lrn="' . $data->lrn . '"
                    ><i class="bx bx-edit"></i></a>';
                    return $btn;
                })->rawColumns(['lrn', 'fullname', 'action'])
                ->make(true);
        }
    }

    public function showRecord($lrn, $section_id)
    {
        $student = Studentinfo::where('lrn', $lrn)->get();
        $section = Section::where('id', $section_id)->get();
        $subjects = SectionSubject::where('section_id', $section_id)->get();


        if (count($section) <= 0) {
            return abort(404);
        }
        if (count($student) > 0) {

            $existingRecord = Record::where('lrn', $lrn)
                ->where('section_id', $section_id)
                ->where('school_year', $section[0]->school_year)
                ->get();


            return view('user-teacher.record', compact('student', 'section', 'subjects', 'existingRecord'));
        }
        return abort(404);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'select' => 'required',
                'quarter_1' => 'required',
                'quarter_2' => 'required',
                'quarter_3' => 'required',
                'quarter_4' => 'required',
            ],
            [
                'select.required' => 'this field is required',
                'quarter_1.required' => 'this field is required',
                'quarter_2.required' => 'this field is required',
                'quarter_3.required' => 'this field is required',
                'quarter_4.required' => 'this field is required',
            ]
        );

        if (!$validator->passes()) {

            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }

        $grade_validator = Validator::make(
            $request->all(),
            [
                'select.*' => 'required',
                'quarter_1.*' => 'required|numeric|min:0|max:100',
                'quarter_2.*' => 'required|numeric|min:0|max:100',
                'quarter_3.*' => 'required|numeric|min:0|max:100',
                'quarter_4.*' => 'required|numeric|min:0|max:100',
            ],
            [
                'select.required' => 'this field is required',
                'quarter_1.required.*' => 'this field is required',
                'quarter_2.required.*' => 'this field is required',
                'quarter_3.required.*' => 'this field is required',
                'quarter_4.required.*' => 'this field is required',
            ]
        );
        if (!$grade_validator->passes()) {

            return response()->json(['status' => 500, 'error' => 'Learning areas is required and Quarter rating must be in numeric values.(max 100.00)']);
        }

        $schoolinfo = Otherinformation::select('school_name', 'school_id', 'district', 'division', 'region')->get();

        $learning_areas = [];

        $gen_ave = 0;

        for ($i = 0; $i < count($request->select); $i++) {

            $final_rating = 0;
            $final_rating = ($request->quarter_1[$i] + $request->quarter_2[$i] + $request->quarter_3[$i] + $request->quarter_4[$i]) / 4;
            $gen_ave += $final_rating;
            array_push($learning_areas, [
                $request->select[$i] => [
                    'quarter_1' => $request->quarter_1[$i],
                    'quarter_2' => $request->quarter_2[$i],
                    'quarter_3' => $request->quarter_3[$i],
                    'quarter_4' => $request->quarter_4[$i],
                    'final' => number_format((float)$final_rating, 2, '.', ''),
                    'remark' => $final_rating >= 75 ? 'PASSED' : 'FAILED'
                ]
            ]);
        }

        $remedials = [];

        if ($request->remedials != null) {
            for ($i = 0; $i < count($request->remedials); $i++) {

                if ($request->remedials[$i] != null) {
                    array_push(
                        $remedials,
                        [
                            'remedials' => $request->remedials[$i],
                            'remedials_rating' => $request->remedials_rating[$i],
                            'remedial_class_mark' => $request->remedials_class_mark[$i],
                            'remedials_final_grade' => $request->remedials_final_grades[$i],
                            'remedials_remarks' => $request->remedials_remarks[$i],
                        ]
                    );
                }
            }
        }

        $gender = Studentinfo::select('sex')->where('lrn', $request->lrn)->get();

        $data = [
            'lrn' => $request->lrn,
            'sex' => $gender[0]->sex,
            'school' => $schoolinfo[0]->school_name,
            'school_id' => $schoolinfo[0]->school_id,
            'district' => $schoolinfo[0]->district,
            'division' => $schoolinfo[0]->division,
            'region' => $schoolinfo[0]->region,
            'classified_grade' => $request->classified_grade,
            'section' => $request->section,
            'section_id' => $request->section_id,
            'school_year' => $request->school_year,
            'adviser' => $request->adviser,
            'data' => $learning_areas,
            'remedial_date_from' => count($remedials) > 0 ? $request->remedial_date_from : '',
            'remedial_date_to' => count($remedials) > 0 ? $request->remedial_date_to : '',
            'remedials' => $remedials,
            'gen_ave' => ($gen_ave) / count($request->select)
        ];

        $existingRecord = Record::where('lrn', $request->lrn)
            ->where('section_id', $request->section_id)
            ->where('school_year', $request->school_year)
            ->get();

        if (count($existingRecord) <= 0) {

            Record::create($data);
        } else {

            Record::where('lrn', $request->lrn)
                ->where('section_id', $request->section_id)
                ->where('school_year', $request->school_year)
                ->update($data);
        }


        return response()->json(['status' => 200, 'msg' => 'Record has been saved!.', 'data' => $data]);
    }
}
