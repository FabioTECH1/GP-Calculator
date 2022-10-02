<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest'])->only('login');
    }
    public function index()
    {
        return view('guest.login');
    }

    public function login(Request $request)
    {
        //email and password validations
        $request->validate([
            'email' => 'required | email',
            'password' => 'required'
        ]);
        //check credentials to log in user
        $checkLogin = ($request->only('email', 'password'));

        if (Auth::attempt($checkLogin)) {
            return redirect()->route('home')->with('msg-2', 'Welcome' . ' ' . auth()->user()->lname);
        } else
            //starts a flash session and returns a message for unregisstered users
            return back()->with('msg-3', ' ');
    }

    public function logout(Request $request)
    {
        // log user out
        Auth::logout();
        return redirect('/');
    }
}