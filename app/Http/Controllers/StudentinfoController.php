<?php

namespace App\Http\Controllers;

use App\Models\OtherStudentinfo;
use App\Models\Record;
use App\Models\Studentinfo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Validator;
use Yajra\DataTables\Datatables;

use function GuzzleHttp\Promise\all;

class StudentinfoController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'isAdmin']);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Studentinfo::select('lrn', 'firstname', 'lastname', 'middlename', 'sex')
                ->orderBy('created_at', 'desc')->get();
            return Datatables::of($data)
                ->addColumn('fullname', function ($data) {
                    $fullname = $data->lastname . ', ' . $data->firstname . ' ' . $data->middlename . '.';
                    return $fullname;
                })
                ->addColumn('sex', function ($data) {
                    return $data->sex === 0 ? 'Male' : 'Female';
                })
                ->addColumn('action', function ($data) {
                    $btn = '<button class="text-white btn btn-success btn-edit" data-id="' . $data->lrn . '"><i class="bx bx-edit"></i></button>
                     <button class="text-white btn btn-danger btn-delete" data-id="' . $data->lrn . '"><i class="bx bx-trash"></i></button>
                     <button class="text-white btn btn-warning btn-show" data-id="' . $data->lrn . '"><i class="bx bx-show"></i></button>';

                    return $btn;
                })->rawColumns(['action', 'fullname', 'sex'])
                ->make(true);
        }
    }

    public function show($lrn)
    {
        $student = Studentinfo::where('lrn', $lrn)
            ->with(['student_record' => function ($query) {
                $query->orderBy('school_year');
                $query->orderBy('classified_grade');
            }, 'otherinfo'])
            ->get();

        if (count($student) > 0) {

            $user = Auth::user();
            return view('output.index', compact('student', 'user'));
        }
        abort(404);
    }

    public function store(Request $request)
    {
        //regex:/^[a-zA-Z ]+$/u

        $validator = Validator::make(
            $request->all(),
            [
                'firstname' => 'required|regex:/^[a-zA-Z ]+$/u',
                'lastname' => 'required|regex:/^[a-zA-Z ]+$/u',
                'birthdate' => 'required|date|before:' . now()->format('Y-m-d'),
                'sex' => 'required',
                'elem_school' => 'required',
                'elem_school_id' => 'required',
                'elem_school_address' => 'required',
                'gen_ave' => 'required|not_in:0|numeric|between:75,100.00',
                'lrn' => 'required|min:12|max:12|unique:studentinfos',
            ],
            [
                'lrn.unique' => 'LRN is already existing.'
            ]
        );

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }


        Studentinfo::create(
            [
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'lastname' => $request->lastname,
                'name_ext' => $request->name_ext,
                'birthdate' => Carbon::parse($request->birthdate)->format('m/d/Y'),
                'sex' => $request->sex,
                'elem_school' => $request->elem_school,
                'elem_school_id' => $request->elem_school_id,
                'elem_school_address' => $request->elem_school_address,
                'gen_ave' => intval($request->gen_ave),
                'lrn' => $request->lrn
            ]
        );

        return response()->json(['status' => 200, 'msg' => ' LRN - [' . $request->lrn . '] Student information has been save']);
    }

    public function edit($lrn)
    {
        try {
            $student = Studentinfo::where('lrn', $lrn)
                ->with('otherinfo')
                ->get();

            if ($student[0]->exists()) {

                return view('partials.student_info_edit', compact('student'));
            }
        } catch (\Throwable $th) {
            return abort(404);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'firstname' => 'required|regex:/^[a-zA-Z ]+$/u',
                'lastname' => 'required|regex:/^[a-zA-Z ]+$/u',
                'birthdate' => 'required|date|before:' . now()->format('Y-m-d'),
                'sex' => 'required',
                'elem_school' => 'required',
                'elem_school_id' => 'required',
                'elem_school_address' => 'required',
                'gen_ave' => 'required|regex:/^\d+(\.\d{1,2})?$/|min:1|not_in:0|numeric|between:75,100.00',
                'lrn' => 'required|min:12|max:12',
            ],
            [
                'lrn.unique' => 'LRN is already existing.'
            ]
        );

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }
        try {


            $recordlrn = Studentinfo::find($id);

            Record::where('lrn', $recordlrn->lrn)->update(['lrn' => $request->lrn]);

            Studentinfo::where('id', $id)
                ->update([
                    'firstname' => $request->firstname,
                    'middlename' => $request->middlename,
                    'lastname' => $request->lastname,
                    'name_ext' => $request->name_ext,
                    'birthdate' => $request->birthdate,
                    'sex' => $request->sex,
                    'elem_school' => $request->elem_school,
                    'elem_school_id' => $request->elem_school_id,
                    'elem_school_address' => $request->elem_school_address,
                    'gen_ave' => $request->gen_ave,
                    'lrn' => $request->lrn
                ]);



            return response()->json(['status' => 200, 'msg' => 'Changes has been saved!.']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 500, 'msg' => $th]);
        }
    }

    public function store_other(Request $request, $lrn)
    {

        OtherStudentinfo::upsert(
            [
                'pept_rating' => $request->pept_rating,
                'pept_date_assestment' => $request->pept_date_assesstment,
                'als_rating' => $request->als_rating,
                'als_name_address' => $request->als_name_address,
                'others' => $request->others,
                'lrn' => $lrn
            ],
            ['lrn'],
            ['pept_rating', 'pept_date_assestment', 'als_rating', 'als_name_address', 'others']
        );

        return response()->json(['status' => 200, 'msg' => 'Changes has been saved!.']);
    }

    public function destroy($lrn)
    {
        $student = Studentinfo::where('lrn', $lrn)->with(['otherinfo', 'student_record'])->get();


        $student[0]->otherinfo()->delete();
        $student[0]->student_record()->delete();
        $student[0]->delete();

        return response()->json(['status' => 200, 'msg' => 'Record has been deleted!.']);
    }
}
