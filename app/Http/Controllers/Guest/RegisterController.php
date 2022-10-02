<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Mail\verifymail;
use App\Models\User;
use App\Models\verify_user;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }
    public function index()
    {
        return view('guest.register');
    }

    public function store(Request $request)
    {
        // email and password validations
        $request->validate([
            'fname' => 'required | string ',
            'mname' => 'string',
            'lname' => 'required | string ',
            'email' => 'required | email ',
            'password' => 'required | confirmed | min:6 | max:15'
        ]);

        //check if user with the email already exist
        $usercount = User::where('email', $request->email)->first();
        if ($usercount) {
            return back()->with('msg-4', ' ');
        }

        //store data to database
        $user = User::create([
            'email' => $request->email,
            'fname' => ucwords($request->fname),
            'mname' => ucwords($request->mname),
            'lname' => ucwords($request->lname),
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('login')->with('msg-5', ' ');
    }
}