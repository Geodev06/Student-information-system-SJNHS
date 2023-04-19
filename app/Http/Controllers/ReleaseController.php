<?php

namespace App\Http\Controllers;

use App\Models\Release;
use App\Models\Studentinfo;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReleaseController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'isAdmin']);
    }

    public function release()
    {
        $releases = Release::all()->values()->reverse();

        return view('partials.release', compact('releases'));
    }

    public function print($lrn, $name_of_school, $school_id)
    {
        $student = Studentinfo::where('lrn', $lrn)
            ->with(['student_record' => function ($query) {
                $query->orderBy('school_year');
                $query->orderBy('classified_grade');
            }, 'otherinfo'])
            ->get();

        if (count($student) > 0) {

            $user = Auth::user();
            return view('output.form137', compact('student', 'user', 'name_of_school', 'school_id'));
        }
        abort(404);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lrn' => 'required|min:12|max:12',
            'school_id' => 'required',
            'name_of_school' => 'required',

        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }

        $record = Studentinfo::where('lrn', $request->lrn)->get();

        if (count($record) <= 0) {
            return response()->json(['status' => -1, 'error' => 'LRN does not exists!.']);
        }
        Release::create([
            'lrn' => $request->lrn,
            'school_id' => $request->school_id,
            'name_of_school' => strtoupper($request->name_of_school)
        ]);

        return response()->json(['status' => 200, 'msg' => 'Release has been recorded']);
    }
}
