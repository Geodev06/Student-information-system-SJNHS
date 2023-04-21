<?php

namespace App\Http\Controllers;

use App\Models\Otherinformation;
use App\Models\Section;
use App\Models\SectionStudent;
use App\Models\SectionSubject;
use App\Models\Studentinfo;
use App\Models\Subject;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Validator;
use Yajra\DataTables\Datatables;

class SectionController extends Controller
{
    function __construct()
    {
        $this->middleware(['auth', 'isAdmin']);
    }

    public function index()
    {
        $teachers = User::where('role', 1)->get();
        $subjects = Subject::select('code', 'description')->get();
        $students = Studentinfo::select('lrn', 'firstname', 'middlename', 'lastname')->get();

        return view('partials.class_management', compact('teachers', 'subjects', 'students'));
    }

    public function store(Request $request)
    {


        if (Otherinformation::count() <= 0) {
            return response()->json(['status' => 500, 'msg' => 'Please go to settings and update your school information.']);
        }

        $validator = Validator::make(
            $request->all(),
            [
                'section' => 'required',
                'teacher_id' => 'required',
                'grade_level' => 'required',
                'school_year' => 'required'
            ],
            [
                'teacher_id.required' => 'Teacher/Adviser is required'
            ]
        );

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }

        $teacher = User::where('role', 1)
            ->where('id', $request->teacher_id)->get();

        Section::create([
            'section' => $request->section,
            'teacher_id' => $request->teacher_id,
            'teacher_name' => $teacher[0]->firstname . ' ' . $teacher[0]->middlename . ' ' . $teacher[0]->lastname,
            'grade_level' => $request->grade_level,
            'school_year' => $request->school_year
        ]);

        return response()->json(['status' => 200, 'msg' => 'Class has been created!']);
    }

    public function update(Request $request, $id)
    {
        if (Otherinformation::count() <= 0) {
            return response()->json(['status' => 500, 'msg' => 'Please go to settings and update your school information.']);
        }

        $validator = Validator::make(
            $request->all(),
            [
                'e_section' => 'required',
                'e_teacher_id' => 'required',
                'e_grade_level' => 'required',
                'e_school_year' => 'required'
            ],
            [
                'e_teacher_id.required' => 'Teacher/Adviser is required'
            ]
        );

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }

        $teacher = User::where('role', 1)
            ->where('id', $request->e_teacher_id)->get();

        Section::where('id', $id)->update([
            'section' => $request->e_section,
            'teacher_id' => $request->e_teacher_id,
            'teacher_name' => $teacher[0]->firstname . ' ' . $teacher[0]->middlename . ' ' . $teacher[0]->lastname,
            'grade_level' => $request->e_grade_level,
            'school_year' => $request->e_school_year
        ]);

        return response()->json(['status' => 200, 'msg' => 'Class has been updated!']);
    }

    public function show(Request $request)
    {

        if ($request->ajax()) {
            $data = Section::select('id', 'section', 'teacher_name', 'teacher_id', 'grade_level', 'school_year')
                ->orderBy('created_at', 'desc')
                ->get();
            return DataTables::of($data)
                ->addColumn('id', function ($data) {
                    return $data->id;
                })
                ->addColumn('section', function ($data) {
                    return $data->section;
                })
                ->addColumn('teacher_name', function ($data) {
                    return $data->teacher_name;
                })
                ->addColumn('grade_level', function ($data) {
                    return 'Grade ' . $data->grade_level;
                })
                ->addColumn('school_year', function ($data) {
                    return $data->school_year;
                })
                ->addColumn('action', function ($data) {
                    $btn = '<button class="text-white btn btn-success btn-edit" data-id="' . $data->id . '"
                      data-section="' . $data->section . '"
                    data-teacherid="' . $data->teacher_id . '"
                    data-teachername="' . $data->teacher_name . '"
                    data-gradelevel="' . $data->grade_level . '"
                    data-sy="' . $data->school_year . '"
                    ><i class="bx bx-edit"></i></button>
                    <button class="text-white btn btn-danger btn-delete" data-id="' . $data->id . '"
                     data-section="' . $data->section . '"
                    ><i class="bx bx-trash"></i></button>
                      <button class="text-white btn btn-info btn-add-subject" data-id="' . $data->id . '"
                     data-section="' . $data->section . '"
                    ><i class="bx bx-book-add"></i></button>
                     <button class="text-white btn btn-dark btn-add-student" data-id="' . $data->id . '"
                     data-section="' . $data->section . '"
                    ><i class="bx bx-male-female"></i></button>';
                    return $btn;
                })->rawColumns(['action', 'section', 'teacher_name', 'grade_level', 'school_year'])
                ->make(true);
        }
    }

    public function destroy($id)
    {
        Section::where('id', $id)->delete();
        SectionSubject::where('section_id', $id)->delete();
        SectionStudent::where('section_id', $id)->delete();
        return response()->json(['status' => 200, 'msg' => 'Class has been deleted!']);
    }

    public function storeSubject(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'subject_code' => 'required'
            ],
            [
                'subject_code.required' => 'Please select a subject'
            ]
        );

        $isSubjectExist = SectionSubject::where('section_id', $request->section_id)
            ->where('subject_code', $request->subject_code)
            ->count();

        if ($isSubjectExist > 0) {
            return response()->json(['status' => 500, 'msg' => 'Subject already exist']);
        }

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }

        $subject = Subject::where('code', $request->subject_code)->select('description')->get();

        $data = [
            'section_id' => $request->section_id,
            'subject_code' => $request->subject_code,
            'subject' => $subject[0]->description
        ];

        SectionSubject::create($data);
        return response()->json(['status' => 200, 'msg' => 'Subject has been added!']);
    }

    public function getSubjects($id)
    {
        $data = SectionSubject::where('section_id', $id)->orderBy('id', 'desc')->get();
        return response()->json(['status' => 200, 'subject' => $data]);
    }

    public function destroySubjects($id)
    {
        SectionSubject::where('id', $id)->delete();
        return response()->json(['status' => 200]);
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

    public function useDefaultSubjects($id)
    {
        SectionSubject::where('section_id', $id)->delete();

        $DEFAULT_SUBJECTS = [
            'FILIPINO',
            'ENGLISH',
            'MATHEMATICS',
            'SCIENCE',
            'ARALING PANLIPUNAN (AP)',
            'EDUKASYON SA PAGPAPAKATAO (ESP)',
            'TECHNOLOGY AND LIVELIHOOD EDUCATION (TLE)',
            'MUSIC',
            'ARTS',
            'PHYSICAL EDUCATION',
            'HEALTH'

        ];

        $subjects = [];
        $grade_level = Section::where('id', $id)->select('grade_level')->get();

        for ($i = 0; $i < count($DEFAULT_SUBJECTS); $i++) {

            array_push(
                $subjects,
                [
                    'section_id' => $id,
                    'subject_code' => $this->randomString(4),
                    'subject' => $DEFAULT_SUBJECTS[$i] . ' ' . $grade_level[0]->grade_level
                ]
            );
        }

        for ($i = 0; $i < count($subjects); $i++) {
            SectionSubject::create($subjects[$i]);
        }

        return response()->json(['status' => 200, 'msg' => 'Subjects has been set!']);
    }

    public function destroySubjectsAll($id)
    {
        SectionSubject::where('section_id', $id)->delete();
        return response()->json(['status' => 200, 'msg' => 'Subjects has been deleted!']);
    }

    public function storeStudent(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'lrn' => 'required'
            ],
            [
                'lrn.required' => 'Please select a student'
            ]
        );

        $student = SectionStudent::where('section_id', $request->section_id)
            ->where('lrn', $request->lrn)
            ->count();

        if ($student > 0) {
            return response()->json(['status' => 500, 'msg' => 'Student already exist']);
        }

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }

        $student = Studentinfo::where('lrn', $request->lrn)->select('lastname', 'middlename', 'firstname')->get();

        $data = [
            'section_id' => $request->section_id,
            'lrn' => $request->lrn,
            'fullname' => $student[0]->lastname . ' ' . $student[0]->firstname . ' ' . $student[0]->middlename
        ];

        SectionStudent::create($data);

        return response()->json(['status' => 200, 'msg' => 'Student has been added!']);
    }

    public function getStudents($id)
    {
        $data = SectionStudent::where('section_id', $id)
            ->orderBy('fullname', 'asc')->get();

        return response()->json(['status' => 200, 'student' => $data]);
    }

    public function destroyStudents($id)
    {
        SectionStudent::where('id', $id)->delete();
        return response()->json(['status' => 200]);
    }

    public function destroyStudentAll($id)
    {
        SectionStudent::where('section_id', $id)->delete();
        return response()->json(['status' => 200]);
    }
}
