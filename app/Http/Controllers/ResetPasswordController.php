<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Validator;

class ResetPasswordController extends Controller
{
    public function check_email(Request $request)
    {
        $user = User::where('email', $request->email)->get();
        DB::table('password_reset_tokens')->delete();
        if (count($user) > 0) {

            DB::table('password_reset_tokens')->insert([
                'email' => $request->email,
                'token' => Carbon::parse()->now()->format('Y-m-d-i'),
                'created_at' => now()
            ]);

            $token = DB::table('password_reset_tokens')->select('*')->get();

            return response()->json(['status' => 200, 'redirect' => route('user.verify', $token[0]->token)]);
        }

        return response()->json(['msg' => 'This user is not existing!.', 'status' => 404]);
    }

    public function verify($token)
    {
        $email = DB::table('password_reset_tokens')->select('email', 'token')->where('token', $token)->get();

        if (count($email) <= 0) {
            abort(404, 'Session expired!');
        }

        $data = User::select('security_question', 'security_answer', 'email')->where('email', $email[0]->email)->get();

        return view('auth.verify', compact('data', 'email'));
    }

    public function verify_submit(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'security_answer' => 'required',
            ]
        );

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }

        $user = User::where('security_answer', $request->security_answer)->get();

        if (count($user) > 0) {
            return response()->json(['status' => 200, 'redirect' => route('password.reset.show', $request->reset_token)]);
        } else {
            return response()->json(['status' => 401, 'msg' => 'Wrong security answer']);
        }
    }

    public function EditPassword(Request $request, $token)
    {
        $data = DB::table('password_reset_tokens')->select('email')->where('token', $token)->get();
        if (count($data) > 0) {
            return view('auth.reset', compact('data'));
        }

        abort(404);
    }

    public function saved_new_password(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'password' => 'required|min:8|confirmed',
            ]
        );

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }

        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password)
        ]);
        DB::table('password_reset_tokens')->delete();
        return response()->json(['status' => 200, 'msg' => 'Your password has been successfully changed!']);
    }

    public function other(Request $request)
    {

        $user = Auth::user();

        User::where('id', $user->id)->update([
            'admin_name' => $request->admin_name
        ]);

        return response()->json(['status' => 200, 'msg' => 'Your changes has been successfully changed!']);
    }
}
