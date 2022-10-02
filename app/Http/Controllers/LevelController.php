<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($profile_id, Request $request)
    {
        $profile = auth()->user()->profile->where('profile_id', $profile_id)->first();

        // cgpa calc
        $total_unit = 0;
        $cummulative = 0;
        $cgpa = '';
        foreach ($profile->level as $level) {
            foreach ($level->result as $result) {
                foreach ($result->unit as $key => $unit) {
                    $cummulative = $cummulative + ($unit * $result->grade[$key]);
                    $total_unit = $total_unit + $unit;
                }
            }
        }
        if ($total_unit) {
            $cgpa = $cummulative / $total_unit;
            $cgpa = number_format($cgpa, 2);
        }
        $request->session()->put('prof_id', $profile_id);
        return view('level', [
            'profile' => $profile,
            'cgpa' => $cgpa
        ]);
    }
    public function add_level($profile_id, Request $request)
    {
        $profile = auth()->user()->profile->where('profile_id', $profile_id)->first();
        $level = $profile->level->where('level', $request->level)->first();
        if ($level) {
            return back();
        } else
            $level =  $profile->level()->create([
                'level' => $request->level,
            ]);
        return redirect()->route('result', [$profile_id, $level->id]);
    }
}