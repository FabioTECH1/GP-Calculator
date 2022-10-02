<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add_profile(Request $request)
    {
        if (auth()->user()->profile->count() < 2) {
            function randomee($a)
            {
                $b = 1;
                $d = Request('profile_name');
                while ($b <= $a) {
                    $c = rand(0, 9);
                    $d = $d . $c;
                    $b++;
                }
                return $d;
            }
            $profile_id = randomee(20);
            $user = User::where('id', Auth::id())->first();
            $user->profile()->create([
                'profile_name' => $request->profile_name,
                'profile_id' => $profile_id,
                'gp_type' => $request->gp_type
            ]);
            return redirect()->route('level', $profile_id);
        } else {
            return back()->with('info', ' ');
        }
    }
    public function delete_profile($profile_id)
    {
        $user = User::where('id', Auth::id())->first();
        $user->profile()->where('profile_id', $profile_id)->delete();
        return back();
    }
}