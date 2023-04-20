<?php

namespace App\Http\Controllers;

use App\Models\Otherinformation;
use App\Models\Section;
use App\Models\User;
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
        return view('partials.class_management', compact('teachers'));
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

        return response()->json(['status' => 200, 'msg' => 'Class has been created!']);
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
                    return $data->grade_level;
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
                      <button class="text-white btn btn-info btn-add-subj" data-id="' . $data->id . '"
                     data-section="' . $data->section . '"
                    ><i class="bx bx-book-add"></i></button>
                     <button class="text-white btn btn-dark btn-add-student" data-id="' . $data->id . '"
                     data-section="' . $data->section . '"
                    ><i class="bx bx-male-female"></i></button>';
                    return $btn;
                })->rawColumns(['id', 'action', 'section', 'teacher_name', 'grade_level', 'school_year'])
                ->make(true);
        }
    }

    public function destroy($id)
    {
        Section::where('id', $id)->delete();
        return response()->json(['status' => 200, 'msg' => 'Class has been deleted!']);
    }
}
