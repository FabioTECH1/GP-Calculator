<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\passwordreset;
use App\Models\password_reset;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }
    public function index()
    {
        return view('guest.forgetpass');
    }

    public function resetLink(Request $request)
    {
        $request->validate([
            'email' => 'required | email ',
        ]);

        $user = User::where('email', $request->email)->first();
        // check if user exists
        if ($user) {
            password_reset::create([
                'user_id' => $user->id,
                'token' => Str::random(70),
            ]);

            //send reset link to mail
            Mail::to($request->email)->send(new passwordreset($user));
            return back()->with('msg-9', 'Check your mail for instructions to reset your password
            setting a new one');
        } else {
            return back()->with('msg-9', "Oops, Account doesn't exist");
        }
    }

    public function resetpassword($user_id, $token)
    {
        $check = password_reset::where('token', $token)->where('user_id', $user_id)->first();
        if ($check) {
            return view('guest.resetpage', ['user_id' => $user_id, 'token' => $token]);
        } else return view('errors.404');
    }

    public function finalreset($user_id, $token, Request $request)
    {
        // change password
        $request->validate([
            'password' => 'required | confirmed | min:6 | max:15'
        ]);
        $check = password_reset::where('token', $token)->where('user_id', $user_id)->first();

        if ($check) {
            User::where('id', $user_id)->update([
                'password' => Hash::make($request->password)
            ]);
            $check->delete();
            return redirect()->route('login')->with('msg-11', ' ');
        } else return view('errors.404');
    }
}
