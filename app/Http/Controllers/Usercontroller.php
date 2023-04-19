<?php

namespace App\Http\Controllers;

use App\Models\Studentinfo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use Yajra\DataTables\Facades\DataTables;

class Usercontroller extends Controller
{
    public function index()
    {
        if (User::count() > 0) {
            return redirect()->route('login');
        }
        return redirect()->route('register');
    }

    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        if (User::count() <= 0) {
            return redirect()->route('register');
        }
        return view('auth.login');
    }

    public function showRegister()
    {
        # code...
        if (User::count() > 0) {
            return redirect()->route('login');
        }
        return view('auth.register');
    }

    public function userStore(Request $request)
    {

        if (User::count() > 0) {
            return response()->json(['status' => 401, 'redirect' => route('login')]);
        }
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|regex:/^[a-zA-Z ]+$/u',
            'lastname' => 'required|regex:/^[a-zA-Z ]+$/u',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'security_question' => 'required',
            'security_answer' => 'required'
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }

        User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'security_question' => $request->security_question,
            'role' => 0,
            'security_answer' => $request->security_answer
        ]);

        return response()->json(['status' => 200, 'success' => route('login')]);
    }

    public function addUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|regex:/^[a-zA-Z ]+$/u',
            'lastname' => 'required|regex:/^[a-zA-Z ]+$/u',
            'email' => 'required|email|unique:users'
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }

        $password = 'sjnhs2023';

        User::create([
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($password),
            'role' => 1
        ]);

        return response()->json(['status' => 200, 'msg' => 'User has been created!']);
    }

    public function editUser(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'e_firstname' => 'required|regex:/^[a-zA-Z ]+$/u',
                'e_lastname' => 'required|regex:/^[a-zA-Z ]+$/u',
                'e_email' => 'required|email'
            ],
            [
                'e_firstname.required' => 'firstname is required!',
                'e_lastname.required' => 'lastname is required!',
                'e_email.required' => 'email is required!',
                'e_firstname.regex' => 'firstname should not contain special characters!',
                'e_lastname.regex' => 'lastname hould not contain special characters!'
            ]
        );

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }

        try {
            User::where('id', $id)->update([
                'firstname' => $request->e_firstname,
                'middlename' => $request->e_middlename,
                'lastname' => $request->e_lastname,
                'email' => $request->e_email
            ]);
        } catch (\Throwable $th) {
            return response()->json(['status' => 500, 'msg' => 'Email is already used!']);
        }

        return response()->json(['status' => 200, 'msg' => 'Changes has been saved!']);
    }

    public function authenticateUser(Request $request)
    {
        # code...
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
        $remember = $request->remember;

        if (Auth::attempt($credentials, $remember)) {
            return response()->json(['status' => 200, 'redirect' => route('dashboard')]);
        }

        return response()->json(['status' => 401, 'msg' => 'Authentication failed']);
    }

    public function destroy($id)
    {
        $user = User::where('id', $id)->delete();

        if ($user) {
            return response()->json(['status' => 200, 'msg' => 'User has been deleted!']);
        }
    }

    public function default($id)
    {
        $user = User::where('id', $id)->get();

        if ($user) {
            $password = 'sjnhs2023';
            User::where('id', $id)->update([
                'password' => Hash::make($password)
            ]);
        }

        return response()->json(['status' => 200, 'msg' => 'Password has been restored!']);
    }

    public function showUsers(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('id', 'firstname', 'lastname', 'middlename', 'email')
                ->where('role', 1)
                ->orderBy('created_at', 'desc');
            return DataTables::of($data)
                ->addColumn('firstname', function ($data) {
                    return $data->firstname;
                })
                ->addColumn('middlaname', function ($data) {
                    return $data->middlename;
                })
                ->addColumn('lastname', function ($data) {
                    return $data->lastname;
                })
                ->addColumn('password', function ($data) {
                    return $data->email;
                })
                ->addColumn('action', function ($data) {
                    $btn = '<button class="text-white btn btn-success btn-edit" data-id="' . $data->id . '" 
                     data-firstname="' . $data->firstname . '"
                     data-middlename="' . $data->middlename . '"
                     data-lastname="' . $data->lastname . '"
                     data-email="' . $data->email . '"
                    ><i class="bx bx-edit"></i></button>
                     <button class="text-white btn btn-danger btn-delete" 
                     data-id="' . $data->id . '"
                     data-firstname="' . $data->firstname . '"
                     data-middlename="' . $data->middlename . '"
                     data-lastname="' . $data->lastname . '"
                     data-email="' . $data->email . '"
                     ><i class="bx bx-trash"></i></button>';
                    return $btn;
                })->rawColumns(['action', 'firstname', 'middlename', 'lastname', 'email'])
                ->make(true);
        }
    }
}
