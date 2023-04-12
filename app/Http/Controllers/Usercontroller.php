<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

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
            'security_answer' => $request->security_answer
        ]);

        return response()->json(['status' => 200, 'success' => route('login')]);
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
}
