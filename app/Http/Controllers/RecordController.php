<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\Studentinfo;
use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class RecordController extends Controller
{

    function __construct()
    {
        $this->middleware(['auth', 'isAdmin']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index($lrn)
    {
        $student = Studentinfo::where('lrn', $lrn)
            ->with(['student_record' => function ($query) {
                $query->orderBy('school_year');
                $query->orderBy('classified_grade');
            }])
            ->get();

        // dd($student[0]->student_record[0]);
        $list_view = view('partials.student_record_list', compact('student'))->render();

        // dd($student[0]->student_record[0]->data);
        return response()->json($list_view, 200);
    }

    public function randomString($length)
    {
        $characters = '1234567890QWERTYUIOPASDFGHJKLZXCVBNM';
        $RANDOMG_STRING = '';

        for ($i = 0; $i < $length; $i++) {
            $RANDOMG_STRING .= $characters[random_int(0, strlen($characters) - 1)];
        }

        return $RANDOMG_STRING;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $learning_areas = [];

        $gen_ave = 0;

        // remedials
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

        if ($request->default == 0) {
            $validator = Validator::make(
                $request->all(),
                [
                    'school' => 'required',
                    'school_id' => 'required',
                    'district' => 'required',
                    'division' => 'required',
                    'region' => 'required',
                    'classified_grade' => 'required',
                    'section' => 'required',
                    'school_year' => 'required',
                    'adviser' => 'required',
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

            for ($i = 0; $i < count($request->select); $i++) {

                $final_rating = 0;
                $final_rating = ($request->quarter_1[$i] + $request->quarter_2[$i] + $request->quarter_3[$i] + $request->quarter_4[$i]) / 4;
                $gen_ave += $final_rating;

                array_push($learning_areas, [
                    $request->select[$i] => [
                        'quarter_1' => round($request->quarter_1[$i]),
                        'quarter_2' => round($request->quarter_2[$i]),
                        'quarter_3' => round($request->quarter_3[$i]),
                        'quarter_4' => round($request->quarter_4[$i]),
                        'final' => round($final_rating),
                        'remark' => $final_rating >= 75 ? 'PASSED' : 'FAILED'
                    ]
                ]);
            }

            $data = [
                'lrn' => $request->lrn,
                'sex' => $gender[0]->sex,
                'school' => $request->school,
                'school_id' => $request->school_id,
                'district' => $request->district,
                'division' => $request->division,
                'region' => $request->region,
                'classified_grade' => $request->classified_grade,
                'section' => $request->section,
                'section_id' => $this->randomString(4),
                'school_year' => $request->school_year,
                'adviser' => $request->adviser,
                'data' => $learning_areas,
                'remedial_date_from' => Carbon::parse($request->remedial_date_from)->format('m/d/Y'),
                'remedial_date_to' =>  Carbon::parse($request->remedial_date_to)->format('m/d/Y'),
                'remedials' => $remedials,
                'gen_ave' => round($gen_ave / count($request->select)),
                'default' => 0
            ];


            Record::create($data);

            return response()->json(['status' => 200, 'msg' => 'Record has been saved!.', 'data' => $data]);
        }

        if ($request->default == 1) {
            $validator = Validator::make(
                $request->all(),
                [
                    'school' => 'required',
                    'school_id' => 'required',
                    'district' => 'required',
                    'division' => 'required',
                    'region' => 'required',
                    'classified_grade' => 'required',
                    'section' => 'required',
                    'school_year' => 'required',
                    'adviser' => 'required'
                ]
            );

            if (!$validator->passes()) {

                return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
            }

            $grade_validator = Validator::make(
                $request->all(),
                [
                    'filipino_q1' => 'required|numeric|min:0|max:100',
                    'filipino_q2' => 'required|numeric|min:0|max:100',
                    'filipino_q3' => 'required|numeric|min:0|max:100',
                    'filipino_q4' => 'required|numeric|min:0|max:100',

                    'english_q1' => 'required|numeric|min:0|max:100',
                    'english_q2' => 'required|numeric|min:0|max:100',
                    'english_q3' => 'required|numeric|min:0|max:100',
                    'english_q4' => 'required|numeric|min:0|max:100',

                    'mathematics_q1' => 'required|numeric|min:0|max:100',
                    'mathematics_q2' => 'required|numeric|min:0|max:100',
                    'mathematics_q3' => 'required|numeric|min:0|max:100',
                    'mathematics_q4' => 'required|numeric|min:0|max:100',

                    'science_q1' => 'required|numeric|min:0|max:100',
                    'science_q2' => 'required|numeric|min:0|max:100',
                    'science_q3' => 'required|numeric|min:0|max:100',
                    'science_q4' => 'required|numeric|min:0|max:100',

                    'ap_q1' => 'required|numeric|min:0|max:100',
                    'ap_q2' => 'required|numeric|min:0|max:100',
                    'ap_q3' => 'required|numeric|min:0|max:100',
                    'ap_q4' => 'required|numeric|min:0|max:100',

                    'esp_q1' => 'required|numeric|min:0|max:100',
                    'esp_q2' => 'required|numeric|min:0|max:100',
                    'esp_q3' => 'required|numeric|min:0|max:100',
                    'esp_q4' => 'required|numeric|min:0|max:100',

                    'tle_q1' => 'required|numeric|min:0|max:100',
                    'tle_q2' => 'required|numeric|min:0|max:100',
                    'tle_q3' => 'required|numeric|min:0|max:100',
                    'tle_q4' => 'required|numeric|min:0|max:100',

                    'music_q1' => 'required|numeric|min:0|max:100',
                    'music_q2' => 'required|numeric|min:0|max:100',
                    'music_q3' => 'required|numeric|min:0|max:100',
                    'music_q4' => 'required|numeric|min:0|max:100',

                    'arts_q1' => 'required|numeric|min:0|max:100',
                    'arts_q2' => 'required|numeric|min:0|max:100',
                    'arts_q3' => 'required|numeric|min:0|max:100',
                    'arts_q4' => 'required|numeric|min:0|max:100',

                    'pe_q1' => 'required|numeric|min:0|max:100',
                    'pe_q2' => 'required|numeric|min:0|max:100',
                    'pe_q3' => 'required|numeric|min:0|max:100',
                    'pe_q4' => 'required|numeric|min:0|max:100',

                    'health_q1' => 'required|numeric|min:0|max:100',
                    'health_q2' => 'required|numeric|min:0|max:100',
                    'health_q3' => 'required|numeric|min:0|max:100',
                    'health_q4' => 'required|numeric|min:0|max:100',
                ]
            );
            if (!$grade_validator->passes()) {


                return response()->json(['status' => 500, 'error' => 'Learning areas is required and Quarter rating must be in numeric values.(max 100.00)']);
            }

            $mapeh_q1 = round(($request->music_q1 + $request->arts_q1 + $request->pe_q1 + $request->health_q1) / 4);
            $mapeh_q2 = round(($request->music_q2 + $request->arts_q2 + $request->pe_q2 + $request->health_q2) / 4);
            $mapeh_q3 = round(($request->music_q3 + $request->arts_q3 + $request->pe_q3 + $request->health_q3) / 4);
            $mapeh_q4 = round(($request->music_q4 + $request->arts_q4 + $request->pe_q4 + $request->health_q4) / 4);
            $mapeh_final = round(($mapeh_q1 + $mapeh_q2 + $mapeh_q3 + $mapeh_q4) / 4);

            $fil = ($request->filipino_q1 + $request->filipino_q2 + $request->filipino_q3 + $request->filipino_q4) / 4;
            $eng = ($request->english_q1 + $request->english_q2 + $request->english_q3 + $request->english_q4) / 4;
            $sci = ($request->science_q1 + $request->science_q2 + $request->science_q3 + $request->science_q4) / 4;
            $math = ($request->mathematics_q1 + $request->mathematics_q2 + $request->mathematics_q3 + $request->mathematics_q4) / 4;
            $ap = ($request->ap_q1 + $request->ap_q2 + $request->ap_q3 + $request->ap_q4) / 4;
            $esp = ($request->esp_q1 + $request->esp_q2 + $request->esp_q3 + $request->esp_q4) / 4;
            $tle = ($request->tle_q1 + $request->tle_q2 + $request->tle_q3 + $request->tle_q4) / 4;

            $gen_ave = round(($fil + $eng + $sci + $math + $ap + $esp + $tle + $mapeh_final) / 8);


            $learning_areas =  [
                [
                    "Filipino" => [
                        'quarter_1' => round($request->filipino_q1),
                        'quarter_2' => round($request->filipino_q2),
                        'quarter_3' => round($request->filipino_q3),
                        'quarter_4' => round($request->filipino_q4),
                        'final' => round(($request->filipino_q1 + $request->filipino_q2 + $request->filipino_q3 + $request->filipino_q4) / 4),
                        'remark' => round(($request->filipino_q1 + $request->filipino_q2 + $request->filipino_q3 + $request->filipino_q4) / 4) >= 75 ? 'PASSED' : 'FAILED'

                    ]
                ],
                [
                    "English" => [
                        'quarter_1' => round($request->english_q1),
                        'quarter_2' => round($request->english_q2),
                        'quarter_3' => round($request->english_q3),
                        'quarter_4' => round($request->english_q4),
                        'final' => round(($request->english_q1 + $request->english_q2 + $request->english_q3 + $request->english_q4) / 4),
                        'remark' => round(($request->english_q1 + $request->english_q2 + $request->english_q3 + $request->english_q4) / 4) >= 75 ? 'PASSED' : 'FAILED'

                    ]
                ],
                [
                    "Mathematics" => [
                        'quarter_1' => round($request->mathematics_q1),
                        'quarter_2' => round($request->mathematics_q2),
                        'quarter_3' => round($request->mathematics_q3),
                        'quarter_4' => round($request->mathematics_q4),
                        'final' => round(($request->mathematics_q1 + $request->mathematics_q2 + $request->mathematics_q3 + $request->mathematics_q4) / 4),
                        'remark' => round(($request->mathematics_q1 + $request->mathematics_q2 + $request->mathematics_q3 + $request->mathematics_q4) / 4) >= 75 ? 'PASSED' : 'FAILED'

                    ]
                ],
                [
                    "Science" => [
                        'quarter_1' => round($request->science_q1),
                        'quarter_2' => round($request->science_q2),
                        'quarter_3' => round($request->science_q3),
                        'quarter_4' => round($request->science_q4),
                        'final' => round(($request->science_q1 + $request->science_q2 + $request->science_q3 + $request->science_q4) / 4),
                        'remark' => round(($request->science_q1 + $request->science_q2 + $request->science_q3 + $request->science_q4) / 4) >= 75 ? 'PASSED' : 'FAILED'

                    ]
                ],
                [
                    "Araling Panlipunan (AP)" => [
                        'quarter_1' => round($request->ap_q1),
                        'quarter_2' => round($request->ap_q2),
                        'quarter_3' => round($request->ap_q3),
                        'quarter_4' => round($request->ap_q4),
                        'final' => round(($request->ap_q1 + $request->ap_q2 + $request->ap_q3 + $request->ap_q4) / 4),
                        'remark' => round(($request->ap_q1 + $request->ap_q2 + $request->ap_q3 + $request->ap_q4) / 4) >= 75 ? 'PASSED' : 'FAILED'

                    ]
                ],
                [
                    "Edukasyon sa Pagpapakatao (ESP)" => [
                        'quarter_1' => round($request->esp_q1),
                        'quarter_2' => round($request->esp_q2),
                        'quarter_3' => round($request->esp_q3),
                        'quarter_4' => round($request->esp_q4),
                        'final' => round(($request->esp_q1 + $request->esp_q2 + $request->esp_q3 + $request->esp_q4) / 4),
                        'remark' => round(($request->esp_q1 + $request->esp_q2 + $request->esp_q3 + $request->esp_q4) / 4) >= 75 ? 'PASSED' : 'FAILED'

                    ]
                ],
                [
                    "Technology and Livelihood Education (TLE)" => [
                        'quarter_1' => round($request->tle_q1),
                        'quarter_2' => round($request->tle_q2),
                        'quarter_3' => round($request->tle_q3),
                        'quarter_4' => round($request->tle_q4),
                        'final' => round(($request->tle_q1 + $request->tle_q2 + $request->tle_q3 + $request->tle_q4) / 4),
                        'remark' => round(($request->tle_q1 + $request->tle_q2 + $request->tle_q3 + $request->tle_q4) / 4) >= 75 ? 'PASSED' : 'FAILED'

                    ]
                ],
                [
                    "MAPEH" => [
                        'quarter_1' => $mapeh_q1,
                        'quarter_2' => $mapeh_q2,
                        'quarter_3' => $mapeh_q3,
                        'quarter_4' => $mapeh_q4,
                        'final' => $mapeh_final,
                        'remark' => $mapeh_final >= 75 ? 'PASSED' : 'FAILED'

                    ]
                ],
                [
                    "Music" => [
                        'quarter_1' => round($request->music_q1),
                        'quarter_2' => round($request->music_q2),
                        'quarter_3' => round($request->music_q3),
                        'quarter_4' => round($request->music_q4),
                        'final' => '',
                        'remark' => ''

                    ]
                ],
                [
                    "Arts" => [
                        'quarter_1' => round($request->arts_q1),
                        'quarter_2' => round($request->arts_q2),
                        'quarter_3' => round($request->arts_q3),
                        'quarter_4' => round($request->arts_q4),
                        'final' => '',
                        'remark' => ''

                    ]
                ],
                [
                    "Physical Education" => [
                        'quarter_1' => round($request->pe_q1),
                        'quarter_2' => round($request->pe_q2),
                        'quarter_3' => round($request->pe_q3),
                        'quarter_4' => round($request->pe_q4),
                        'final' => '',
                        'remark' => ''

                    ]
                ],
                [
                    "Health" => [
                        'quarter_1' => round($request->health_q1),
                        'quarter_2' => round($request->health_q1),
                        'quarter_3' => round($request->health_q1),
                        'quarter_4' => round($request->health_q1),
                        'final' => '',
                        'remark' => ''

                    ]
                ]

            ];

            $data = [
                'lrn' => $request->lrn,
                'sex' => $gender[0]->sex,
                'school' => $request->school,
                'school_id' => $request->school_id,
                'district' => $request->district,
                'division' => $request->division,
                'region' => $request->region,
                'classified_grade' => $request->classified_grade,
                'section' => $request->section,
                'section_id' => $this->randomString(4),
                'school_year' => $request->school_year,
                'adviser' => $request->adviser,
                'data' => $learning_areas,
                'remedial_date_from' =>  Carbon::parse($request->remedial_date_from)->format('m/d/Y'),
                'remedial_date_to' =>  Carbon::parse($request->remedial_date_to)->format('m/d/Y'),
                'remedials' => $remedials,
                'gen_ave' => $gen_ave,
                'default' => 1
            ];


            Record::create($data);

            return response()->json(['status' => 200, 'msg' => 'Record has been saved!.', 'data' => $data]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($lrn)
    {
        $student = Studentinfo::where('lrn', $lrn)->get();

        if ($student[0]->exists()) {
            $subjects = Subject::all();
            return view('partials.student_record', compact('student', 'subjects'));
        }

        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, $lrn)
    {
        $student = Record::where(['id' => $id, 'lrn' => $lrn])->get();
        if (count($student) > 0) {
            $subjects = Subject::all();
            return view('partials.student_record_edit', compact('student', 'subjects'));
        }

        abort(404);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $learning_areas = [];

        $gen_ave = 0;

        $remedials = [];
        $gender = Studentinfo::select('sex')->where('lrn', $request->lrn)->get();

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

        if ($request->default == 0) {
            $validator = Validator::make(
                $request->all(),
                [
                    'school' => 'required',
                    'school_id' => 'required',
                    'district' => 'required',
                    'division' => 'required',
                    'region' => 'required',
                    'classified_grade' => 'required',
                    'section' => 'required',
                    'school_year' => 'required',
                    'adviser' => 'required',
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

            for ($i = 0; $i < count($request->select); $i++) {

                $final_rating = 0;
                $final_rating = ($request->quarter_1[$i] + $request->quarter_2[$i] + $request->quarter_3[$i] + $request->quarter_4[$i]) / 4;
                $gen_ave += $final_rating;
                array_push($learning_areas, [
                    $request->select[$i] => [
                        'quarter_1' => round($request->quarter_1[$i]),
                        'quarter_2' => round($request->quarter_2[$i]),
                        'quarter_3' => round($request->quarter_3[$i]),
                        'quarter_4' => round($request->quarter_4[$i]),
                        'final' => round($final_rating),
                        'remark' => $final_rating >= 75 ? 'PASSED' : 'FAILED'
                    ]
                ]);
            }
            $data = [
                'lrn' => $request->lrn,
                'sex' => $gender[0]->sex,
                'school' => $request->school,
                'school_id' => $request->school_id,
                'district' => $request->district,
                'division' => $request->division,
                'region' => $request->region,
                'classified_grade' => $request->classified_grade,
                'section' => $request->section,
                'school_year' => $request->school_year,
                'adviser' => $request->adviser,
                'data' => $learning_areas,
                'remedial_date_from' => $request->remedial_date_from,
                'remedial_date_to' => $request->remedial_date_to,
                'remedials' => $remedials,
                'gen_ave' => round($gen_ave / count($request->select))
            ];

            Record::where('id', $id)->update($data);

            return response()->json(['status' => 200, 'msg' => 'Changes has been saved!.']);
        }

        if ($request->default == 1) {

            $validator = Validator::make(
                $request->all(),
                [
                    'school' => 'required',
                    'school_id' => 'required',
                    'district' => 'required',
                    'division' => 'required',
                    'region' => 'required',
                    'classified_grade' => 'required',
                    'section' => 'required',
                    'school_year' => 'required',
                    'adviser' => 'required'
                ]
            );

            if (!$validator->passes()) {

                return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
            }

            $grade_validator = Validator::make(
                $request->all(),
                [
                    'filipino_q1' => 'required|numeric|min:0|max:100',
                    'filipino_q2' => 'required|numeric|min:0|max:100',
                    'filipino_q3' => 'required|numeric|min:0|max:100',
                    'filipino_q4' => 'required|numeric|min:0|max:100',

                    'english_q1' => 'required|numeric|min:0|max:100',
                    'english_q2' => 'required|numeric|min:0|max:100',
                    'english_q3' => 'required|numeric|min:0|max:100',
                    'english_q4' => 'required|numeric|min:0|max:100',

                    'mathematics_q1' => 'required|numeric|min:0|max:100',
                    'mathematics_q2' => 'required|numeric|min:0|max:100',
                    'mathematics_q3' => 'required|numeric|min:0|max:100',
                    'mathematics_q4' => 'required|numeric|min:0|max:100',

                    'science_q1' => 'required|numeric|min:0|max:100',
                    'science_q2' => 'required|numeric|min:0|max:100',
                    'science_q3' => 'required|numeric|min:0|max:100',
                    'science_q4' => 'required|numeric|min:0|max:100',

                    'ap_q1' => 'required|numeric|min:0|max:100',
                    'ap_q2' => 'required|numeric|min:0|max:100',
                    'ap_q3' => 'required|numeric|min:0|max:100',
                    'ap_q4' => 'required|numeric|min:0|max:100',

                    'esp_q1' => 'required|numeric|min:0|max:100',
                    'esp_q2' => 'required|numeric|min:0|max:100',
                    'esp_q3' => 'required|numeric|min:0|max:100',
                    'esp_q4' => 'required|numeric|min:0|max:100',

                    'tle_q1' => 'required|numeric|min:0|max:100',
                    'tle_q2' => 'required|numeric|min:0|max:100',
                    'tle_q3' => 'required|numeric|min:0|max:100',
                    'tle_q4' => 'required|numeric|min:0|max:100',

                    'music_q1' => 'required|numeric|min:0|max:100',
                    'music_q2' => 'required|numeric|min:0|max:100',
                    'music_q3' => 'required|numeric|min:0|max:100',
                    'music_q4' => 'required|numeric|min:0|max:100',

                    'arts_q1' => 'required|numeric|min:0|max:100',
                    'arts_q2' => 'required|numeric|min:0|max:100',
                    'arts_q3' => 'required|numeric|min:0|max:100',
                    'arts_q4' => 'required|numeric|min:0|max:100',

                    'pe_q1' => 'required|numeric|min:0|max:100',
                    'pe_q2' => 'required|numeric|min:0|max:100',
                    'pe_q3' => 'required|numeric|min:0|max:100',
                    'pe_q4' => 'required|numeric|min:0|max:100',

                    'health_q1' => 'required|numeric|min:0|max:100',
                    'health_q2' => 'required|numeric|min:0|max:100',
                    'health_q3' => 'required|numeric|min:0|max:100',
                    'health_q4' => 'required|numeric|min:0|max:100',
                ]
            );
            if (!$grade_validator->passes()) {

                return response()->json(['status' => 500, 'error' => 'Learning areas is required and Quarter rating must be in numeric values.(max 100.00)']);
            }

            $mapeh_q1 = round(($request->music_q1 + $request->arts_q1 + $request->pe_q1 + $request->health_q1) / 4);
            $mapeh_q2 = round(($request->music_q2 + $request->arts_q2 + $request->pe_q2 + $request->health_q2) / 4);
            $mapeh_q3 = round(($request->music_q3 + $request->arts_q3 + $request->pe_q3 + $request->health_q3) / 4);
            $mapeh_q4 = round(($request->music_q4 + $request->arts_q4 + $request->pe_q4 + $request->health_q4) / 4);
            $mapeh_final = round(($mapeh_q1 + $mapeh_q2 + $mapeh_q3 + $mapeh_q4) / 4);

            $fil = ($request->filipino_q1 + $request->filipino_q2 + $request->filipino_q3 + $request->filipino_q4) / 4;
            $eng = ($request->english_q1 + $request->english_q2 + $request->english_q3 + $request->english_q4) / 4;
            $sci = ($request->science_q1 + $request->science_q2 + $request->science_q3 + $request->science_q4) / 4;
            $math = ($request->mathematics_q1 + $request->mathematics_q2 + $request->mathematics_q3 + $request->mathematics_q4) / 4;
            $ap = ($request->ap_q1 + $request->ap_q2 + $request->ap_q3 + $request->ap_q4) / 4;
            $esp = ($request->esp_q1 + $request->esp_q2 + $request->esp_q3 + $request->esp_q4) / 4;
            $tle = ($request->tle_q1 + $request->tle_q2 + $request->tle_q3 + $request->tle_q4) / 4;

            $gen_ave = round(($fil + $eng + $sci + $math + $ap + $esp + $tle + $mapeh_final) / 8);


            $learning_areas =  [
                [
                    "Filipino" => [
                        'quarter_1' => round($request->filipino_q1),
                        'quarter_2' => round($request->filipino_q2),
                        'quarter_3' => round($request->filipino_q3),
                        'quarter_4' => round($request->filipino_q4),
                        'final' => round(($request->filipino_q1 + $request->filipino_q2 + $request->filipino_q3 + $request->filipino_q4) / 4),
                        'remark' => round(($request->filipino_q1 + $request->filipino_q2 + $request->filipino_q3 + $request->filipino_q4) / 4) >= 75 ? 'PASSED' : 'FAILED'

                    ]
                ],
                [
                    "English" => [
                        'quarter_1' => round($request->english_q1),
                        'quarter_2' => round($request->english_q2),
                        'quarter_3' => round($request->english_q3),
                        'quarter_4' => round($request->english_q4),
                        'final' => round(($request->english_q1 + $request->english_q2 + $request->english_q3 + $request->english_q4) / 4),
                        'remark' => round(($request->english_q1 + $request->english_q2 + $request->english_q3 + $request->english_q4) / 4) >= 75 ? 'PASSED' : 'FAILED'

                    ]
                ],
                [
                    "Mathematics" => [
                        'quarter_1' => round($request->mathematics_q1),
                        'quarter_2' => round($request->mathematics_q2),
                        'quarter_3' => round($request->mathematics_q3),
                        'quarter_4' => round($request->mathematics_q4),
                        'final' => round(($request->mathematics_q1 + $request->mathematics_q2 + $request->mathematics_q3 + $request->mathematics_q4) / 4),
                        'remark' => round(($request->mathematics_q1 + $request->mathematics_q2 + $request->mathematics_q3 + $request->mathematics_q4) / 4) >= 75 ? 'PASSED' : 'FAILED'

                    ]
                ],
                [
                    "Science" => [
                        'quarter_1' => round($request->science_q1),
                        'quarter_2' => round($request->science_q2),
                        'quarter_3' => round($request->science_q3),
                        'quarter_4' => round($request->science_q4),
                        'final' => round(($request->science_q1 + $request->science_q2 + $request->science_q3 + $request->science_q4) / 4),
                        'remark' => round(($request->science_q1 + $request->science_q2 + $request->science_q3 + $request->science_q4) / 4) >= 75 ? 'PASSED' : 'FAILED'

                    ]
                ],
                [
                    "Araling Panlipunan (AP)" => [
                        'quarter_1' => round($request->ap_q1),
                        'quarter_2' => round($request->ap_q2),
                        'quarter_3' => round($request->ap_q3),
                        'quarter_4' => round($request->ap_q4),
                        'final' => round(($request->ap_q1 + $request->ap_q2 + $request->ap_q3 + $request->ap_q4) / 4),
                        'remark' => round(($request->ap_q1 + $request->ap_q2 + $request->ap_q3 + $request->ap_q4) / 4) >= 75 ? 'PASSED' : 'FAILED'

                    ]
                ],
                [
                    "Edukasyon sa Pagpapakatao (ESP)" => [
                        'quarter_1' => round($request->esp_q1),
                        'quarter_2' => round($request->esp_q2),
                        'quarter_3' => round($request->esp_q3),
                        'quarter_4' => round($request->esp_q4),
                        'final' => round(($request->esp_q1 + $request->esp_q2 + $request->esp_q3 + $request->esp_q4) / 4),
                        'remark' => round(($request->esp_q1 + $request->esp_q2 + $request->esp_q3 + $request->esp_q4) / 4) >= 75 ? 'PASSED' : 'FAILED'

                    ]
                ],
                [
                    "Technology and Livelihood Education (TLE)" => [
                        'quarter_1' => round($request->tle_q1),
                        'quarter_2' => round($request->tle_q2),
                        'quarter_3' => round($request->tle_q3),
                        'quarter_4' => round($request->tle_q4),
                        'final' => round(($request->tle_q1 + $request->tle_q2 + $request->tle_q3 + $request->tle_q4) / 4),
                        'remark' => round(($request->tle_q1 + $request->tle_q2 + $request->tle_q3 + $request->tle_q4) / 4) >= 75 ? 'PASSED' : 'FAILED'

                    ]
                ],
                [
                    "MAPEH" => [
                        'quarter_1' => $mapeh_q1,
                        'quarter_2' => $mapeh_q2,
                        'quarter_3' => $mapeh_q3,
                        'quarter_4' => $mapeh_q4,
                        'final' => $mapeh_final,
                        'remark' => $mapeh_final >= 75 ? 'PASSED' : 'FAILED'

                    ]
                ],
                [
                    "Music" => [
                        'quarter_1' => round($request->music_q1),
                        'quarter_2' => round($request->music_q2),
                        'quarter_3' => round($request->music_q3),
                        'quarter_4' => round($request->music_q4),
                        'final' => '',
                        'remark' => ''

                    ]
                ],
                [
                    "Arts" => [
                        'quarter_1' => round($request->arts_q1),
                        'quarter_2' => round($request->arts_q2),
                        'quarter_3' => round($request->arts_q3),
                        'quarter_4' => round($request->arts_q4),
                        'final' => '',
                        'remark' => ''

                    ]
                ],
                [
                    "Physical Education" => [
                        'quarter_1' => round($request->pe_q1),
                        'quarter_2' => round($request->pe_q2),
                        'quarter_3' => round($request->pe_q3),
                        'quarter_4' => round($request->pe_q4),
                        'final' => '',
                        'remark' => ''

                    ]
                ],
                [
                    "Health" => [
                        'quarter_1' => round($request->health_q1),
                        'quarter_2' => round($request->health_q1),
                        'quarter_3' => round($request->health_q1),
                        'quarter_4' => round($request->health_q1),
                        'final' => '',
                        'remark' => ''

                    ]
                ]

            ];

            $data = [
                'lrn' => $request->lrn,
                'sex' => $gender[0]->sex,
                'school' => $request->school,
                'school_id' => $request->school_id,
                'district' => $request->district,
                'division' => $request->division,
                'region' => $request->region,
                'classified_grade' => $request->classified_grade,
                'section' => $request->section,
                'section_id' => $this->randomString(4),
                'school_year' => $request->school_year,
                'adviser' => $request->adviser,
                'data' => $learning_areas,
                'remedial_date_from' => $request->remedial_date_from,
                'remedial_date_to' => $request->remedial_date_to,
                'remedials' => $remedials,
                'gen_ave' => $gen_ave
            ];


            Record::where('id', $id)->update($data);

            return response()->json(['status' => 200, 'msg' => 'Record has been saved!.', 'data' => $data]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $record = Record::where('id', $id)->get();
        if (count($record) > 0) {

            Record::where('id', $id)->delete();

            return redirect()->route('record.show', $record[0]->lrn);
        }

        abort(404);
    }
}
