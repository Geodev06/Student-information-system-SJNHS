<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class SubjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        //regex:/^[a-zA-Z ]+$/u

        $validator = Validator::make(
            $request->all(),
            [
                'code' => 'required|unique:subjects',
                'description' => 'required',
                'unit' => 'required|integer|min:1',
            ],
            [
                'code.unique' => 'Subject code is already existing.'
            ]
        );

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }

        Subject::create([
            'code' => strtoupper($request->code),
            'description' => strtoupper($request->description),
            'unit' => $request->unit
        ]);

        return response()->json(['status' => 200, 'msg' => 'subject created']);
    }

    public function get()
    {
        $subject = Subject::select('id', 'code', 'description', 'unit', DB::raw('date_format(created_at, "%Y-%m-%d") as date'))
            ->get();

        return response()->json($subject, 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'edit_code' => 'required',
                'edit_description' => 'required',
                'edit_unit' => 'required|integer|min:1',
            ],
            [
                'edit_code.required' => 'The code field is required.',
                'edit_description.required' => 'The code description is required.',
                'edit_unit.required' => 'The unit field is required.',
            ]
        );

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }

        try {
            Subject::where('id', $id)->update([
                'code' => strtoupper($request->edit_code),
                'description' => strtoupper($request->edit_description),
                'unit' => $request->edit_unit
            ]);

            return response()->json(['status' => 200, 'msg' => 'Subject has been updated.']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 500, 'msg' => $th]);
        }
    }

    public function destroy($id)
    {
        Subject::where('id', $id)->delete();

        return response()->json(['status' => 200, 'msg' => 'Subject has been deleted.']);
    }
}
