<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\SectionStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

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
                ->select('id', 'lrn', 'fullname')
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
                    $btn = '<button class="text-white btn btn-success btn-edit" data-lrn="' . $data->lrn . '"
                    ><i class="bx bx-edit"></i></button>';
                    return $btn;
                })->rawColumns(['lrn', 'fullname', 'action'])
                ->make(true);
        }
    }
}
