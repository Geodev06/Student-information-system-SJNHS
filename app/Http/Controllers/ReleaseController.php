<?php

namespace App\Http\Controllers;

use App\Models\Otherinformation;
use App\Models\OtherStudentinfo;
use App\Models\Record;
use App\Models\Release;
use App\Models\Studentinfo;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

use PDF;
use PhpParser\Node\Stmt\Return_;

use function Termwind\render;

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

    public function print($lrn, $nos, $nid, Request $request)
    {
        $student = Studentinfo::where('lrn', $lrn)
            ->get();

        $otherinfo = OtherStudentinfo::where('lrn', $lrn)->get();

        if (count($student) > 0) {

            $records = Record::select('*')->where('lrn', $lrn)
                ->orderBy('school_year', 'asc')
                ->get()
                ->toArray();


            $requestdata = [
                'school_req' => $nos,
                'school_id_req' => $nid
            ];


            /**
             * Full docu if the records is Less than five
             */
            if (count($records) < 5) {
                $extendedRecords = [];
                $extendedRecords = array_pad($records, 5, null);
                $breakpoints = [1, 4];


                return view('output.record', compact(
                    'student',
                    'otherinfo',
                    'extendedRecords',
                    'breakpoints',
                    'requestdata'

                ));
            } else {
                $length = 0;

                for ($i = 5; $i < count($records); $i += 3) {
                    # code...

                    if (count($records) > $i && count($records) < ($i + 4)) {
                        $length = $i + 3;
                        break;
                    }
                }

                $extendedRecords = [];
                $extendedRecords = array_pad($records, $length, null);

                $breakpoints = [1, 4, 7, 10, 13, 16, 19, 22, 25];


                return view('output.record', compact(
                    'student',
                    'otherinfo',
                    'extendedRecords',
                    'breakpoints',
                    'requestdata'

                ));
            }
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

        return response()->json([
            'status' => 200, 'msg' => 'Release has been recorded',
            'link' => route('release.print', [$request->lrn, $request->name_of_school, $request->school_id])
        ]);
    }
}
