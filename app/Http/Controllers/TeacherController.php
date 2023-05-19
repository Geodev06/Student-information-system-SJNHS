<?php

namespace App\Http\Controllers;

use App\Models\Otherinformation;
use App\Models\Record;
use App\Models\Section;
use App\Models\SectionStudent;
use App\Models\SectionSubject;
use App\Models\Studentinfo;
use App\Models\User;
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

            $ob_val = Record::where('lrn', $lrn)
                ->where('section_id', $section_id)
                ->where('school_year', $section[0]->school_year)
                ->select('observed_values')
                ->get();

            $decoded_values = [];
            if (count($ob_val) > 0) {
                $decoded_values = json_decode($ob_val[0]->observed_values);
            }


            return view('user-teacher.record', compact('student', 'section', 'subjects', 'existingRecord', 'decoded_values'));
        }
        return abort(404);
    }

    public function store(Request $request)
    {

        $schoolinfo = Otherinformation::select('school_name', 'school_id', 'district', 'division', 'region')->get();
        $gender = Studentinfo::select('sex')->where('lrn', $request->lrn)->get();
        $learning_areas = [];
        $gen_ave = 0;
        $remedials = [];

        $total_days = ($request->aug_sd + $request->sep_sd + $request->oct_sd + $request->nov_sd + $request->dec_sd
            + $request->jan_sd + $request->feb_sd + $request->mar_sd + $request->apr_sd + $request->may_sd + $request->jun_sd + $request->jul_sd);

        $total_present = ($request->aug_pr + $request->sep_pr + $request->oct_pr + $request->nov_pr + $request->dec_pr
            + $request->jan_pr + $request->feb_pr + $request->mar_pr + $request->apr_pr + $request->may_pr + $request->jun_pr + $request->jul_pr);

        $attendance = [
            [
                'august' => [
                    'aug_sd' => $request->aug_sd,
                    'aug_pr' => $request->aug_pr,
                    'aug_ab' => ($request->aug_sd - $request->aug_pr)
                ]
            ],
            [
                'september' => [
                    'sep_sd' => $request->sep_sd,
                    'sep_pr' => $request->sep_pr,
                    'sep_ab' => ($request->sep_sd - $request->sep_pr)
                ]
            ],
            [
                'october' => [
                    'oct_sd' => $request->oct_sd,
                    'oct_pr' => $request->oct_pr,
                    'oct_ab' => ($request->oct_sd - $request->oct_pr)
                ]
            ],
            [
                'november' => [
                    'nov_sd' => $request->nov_sd,
                    'nov_pr' => $request->nov_pr,
                    'nov_ab' => ($request->nov_sd - $request->nov_pr)
                ]
            ],
            [
                'december' => [
                    'dec_sd' => $request->dec_sd,
                    'dec_pr' => $request->dec_pr,
                    'dec_ab' => ($request->dec_sd - $request->dec_pr)
                ]
            ],
            [
                'january' => [
                    'jan_sd' => $request->jan_sd,
                    'jan_pr' => $request->jan_pr,
                    'jan_ab' => ($request->jan_sd - $request->jan_pr)
                ]
            ],
            [
                'february' => [
                    'feb_sd' => $request->feb_sd,
                    'feb_pr' => $request->feb_pr,
                    'feb_ab' => ($request->feb_sd - $request->feb_pr)
                ]
            ],
            [
                'march' => [
                    'mar_sd' => $request->mar_sd,
                    'mar_pr' => $request->mar_pr,
                    'mar_ab' => ($request->mar_sd - $request->mar_pr)
                ]
            ],
            [
                'april' => [
                    'apr_sd' => $request->apr_sd,
                    'apr_pr' => $request->apr_pr,
                    'apr_ab' => ($request->apr_sd - $request->apr_pr)
                ]
            ],
            [
                'may' => [
                    'may_sd' => $request->may_sd,
                    'may_pr' => $request->may_pr,
                    'may_ab' => ($request->may_sd - $request->may_pr)
                ]
            ],
            [
                'june' => [
                    'jun_sd' => $request->jun_sd,
                    'jun_pr' => $request->jun_pr,
                    'jun_ab' => ($request->jun_sd - $request->jun_pr)
                ]
            ],
            [
                'july' => [
                    'jul_sd' => $request->jul_sd,
                    'jul_pr' => $request->jul_pr,
                    'jul_ab' => ($request->jul_sd - $request->jul_pr)
                ]
            ],
            [
                'total' => [
                    'total_days' => $total_days,
                    'total_present' => $total_present,
                    'total_absent' => ($total_days - $total_present)
                ]
            ]
        ];

        $observed_values = [
            [
                'makadiyos' => [
                    'q1' => $request->mk_d1,
                    'q2' => $request->mk_d2,
                    'q3' => $request->mk_d3,
                    'q4' => $request->mk_d4
                ]
            ],
            [
                'makadiyos_2' => [
                    'q1' => $request->mk_d12,
                    'q2' => $request->mk_d22,
                    'q3' => $request->mk_d32,
                    'q4' => $request->mk_d42
                ]
            ],
            [
                'makatao' => [
                    'q1' => $request->mk_t1,
                    'q2' => $request->mk_t2,
                    'q3' => $request->mk_t3,
                    'q4' => $request->mk_t4

                ]
            ],
            [
                'makatao_2' => [
                    'q1' => $request->mk_t12,
                    'q2' => $request->mk_t22,
                    'q3' => $request->mk_t32,
                    'q4' => $request->mk_t42

                ]
            ],
            [
                'makakalikasan' => [
                    'q1' => $request->mk_k1,
                    'q2' => $request->mk_k2,
                    'q3' => $request->mk_k3,
                    'q4' => $request->mk_k4

                ]
            ],
            [
                'makabansa' => [
                    'q1' => $request->mk_b1,
                    'q2' => $request->mk_b2,
                    'q3' => $request->mk_b3,
                    'q4' => $request->mk_b4
                ]
            ],
            [
                'makabansa_2' => [
                    'q1' => $request->mk_b12,
                    'q2' => $request->mk_b22,
                    'q3' => $request->mk_b32,
                    'q4' => $request->mk_b42
                ]
            ]
        ];

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

        $existingRecord = Record::where('lrn', $request->lrn)
            ->where('section_id', $request->section_id)
            ->where('school_year', $request->school_year)
            ->get();

        if (count($existingRecord) <= 0) {

            if ($request->default == 0) {

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
                    'gen_ave' => round(($gen_ave) / count($request->select)),
                    'attendance' => json_encode($attendance),
                    'observed_values' => json_encode($observed_values)
                ];

                Record::create($data);
                return response()->json(['status' => 200, 'msg' => 'Record has been saved!.', 'data' => $data]);
            }

            if ($request->default == 1) {


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
                    'remedial_date_from' => $request->remedial_date_from,
                    'remedial_date_to' => $request->remedial_date_to,
                    'remedials' => $remedials,
                    'gen_ave' => $gen_ave,
                    'default' => 1,
                    'attendance' => json_encode($attendance),
                    'observed_values' => json_encode($observed_values)
                ];


                Record::create($data);

                return response()->json(['status' => 200, 'msg' => 'Record has been saved!.', 'data' => $data]);
            }
        } else {

            //update record

            if ($request->default == 0) {

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
                    'gen_ave' => round(($gen_ave) / count($request->select)),
                    'attendance' => $attendance,
                    'observed_values' => $observed_values,
                ];

                Record::where('school_year', $request->school_year)
                    ->where('lrn', $request->lrn)
                    ->where('section_id', $request->section_id)->update($data);
                return response()->json(['status' => 200, 'msg' => 'Record has been saved!.', 'data' => $data]);
            }

            if ($request->default == 1) {


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
                    'remedial_date_from' => $request->remedial_date_from,
                    'remedial_date_to' => $request->remedial_date_to,
                    'remedials' => $remedials,
                    'gen_ave' => $gen_ave,
                    'default' => 1,
                    'attendance' => json_encode($attendance),
                    'observed_values' => json_encode($observed_values),
                ];


                Record::where('section_id', $request->section_id)
                    ->where('lrn', $request->lrn)
                    ->where('school_year', $request->school_year)
                    ->update($data);

                return response()->json(['status' => 200, 'msg' => 'Record has been saved!.', 'data' => $data]);
            }
        }
    }

    public function cardGen($lrn, $section_id, $sy)
    {
        $record = Record::where('lrn', $lrn)
            ->where('section_id', $section_id)
            ->where('school_year', $sy)
            ->get();


        $ob_val = Record::where('lrn', $lrn)
            ->where('section_id', $section_id)
            ->where('school_year', $sy)
            ->select('observed_values')
            ->get();

        $student = Studentinfo::where('lrn', $lrn)->get();

        $decoded_values = [];
        if (count($ob_val) > 0) {
            $decoded_values = json_decode($ob_val[0]->observed_values);
        }

        if (count($record) <= 0) {
            return abort(404);
        }

        $schoolinfo = Otherinformation::select([
            'school_name'
        ])->get();


        return view('user-teacher.card', compact('record', 'decoded_values', 'student'));
    }
}
