<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($profile_id, $level_id)
    {

        $profile = auth()->user()->profile->where('profile_id', $profile_id)->first();
        $level = $profile->level->where('id', $level_id)->first();
        $results = $level->result;

        // dd($results[1]->semester);
        $cgpa1 = "X.XX";
        $cgpa2 = "X.XX";
        $cgpa = array($cgpa1, $cgpa2);
        $fs_cgpa = '';

        //first semester
        $total_unit = 0;
        $cummulative = 0;
        $first = $results->where('semester', "first")->first();
        // dd($first);
        if ($first) {
            foreach ($first->unit as $key => $unit) {
                $cummulative = $cummulative + ($unit * $first->grade[$key]);
                $total_unit = $total_unit + $unit;
            }
            $cgpa1 = $cummulative / $total_unit;
            $cgpa[0] = number_format($cgpa1, 2);
            // array_push($cgpa, $cgpa1);
        }

        //second semester
        $total_unit = 0;
        $cummulative = 0;
        $second = $results->where('semester', "second")->first();
        if ($second) {
            foreach ($second->unit as $key => $unit) {
                $cummulative = $cummulative + ($unit * $second->grade[$key]);
                $total_unit = $total_unit + $unit;
            }
            $cgpa2 = $cummulative / $total_unit;
            $cgpa[1] = number_format($cgpa2, 2);
            // array_push($cgpa, $cgpa2);
        }
        // dd($cgpa);
        // level cgpa
        if ($first || $second) {
            $total_unit = 0;
            $cummulative = 0;
            $session_result = $level->where('id', $level_id)->first();
            foreach ($session_result->result as $fs_result) {
                foreach ($fs_result->unit as $key => $unit) {
                    $cummulative = $cummulative + ($unit * $fs_result->grade[$key]);
                    $total_unit = $total_unit + $unit;
                }
            }
            $fs_cgpa = $cummulative / $total_unit;
            $fs_cgpa = number_format($fs_cgpa, 2);
        }

        $level = $level->level;
        return view('result', [
            'results' => $results,
            'profile' => $profile,
            'level_id' => $level_id,
            'cgpa' => $cgpa,
            'fs_cgpa' => $fs_cgpa,
            'level' => $level
        ]);
    }

    public function add_result(Request $request, $profile_id, $level_id)
    {
        $profile = auth()->user()->profile->where('profile_id', $profile_id)->first();
        $level = $profile->level()->where('id', $level_id)->first();
        $result = $level->result->where('semester', $request->semester)->first();

        $course_ = $request->course;
        $course_[0] = str_replace(' ', '', $course_[0]);
        $course_[0] = strtoupper($course_[0]);


        if ($result) {
            //check if course is already registered
            $course_check = array_search($course_[0], $result->course);
            if (is_int($course_check)) {
                return 'exists';
            }

            $course = $result->course;
            $unit = $result->unit;
            $grade = $result->grade;
            $grade_alpha = $result->grade_alpha;

            array_push($course, $course_[0]);
            array_push($unit, $request->unit[0]);
            array_push($grade, $request->grade[0]);
            array_push($grade_alpha, $request->grade_alpha[0]);

            $result =  $result->update([
                'course' => $course,
                'unit' => $unit,
                'grade' => $grade,
                'grade_alpha' => $grade_alpha
            ]);
        } else {
            $result =  $level->result()->create([
                'semester' => $request->semester,
                'course' => $course_,
                'grade' => $request->grade,
                'grade_alpha' => $request->grade_alpha,
                'unit' => $request->unit,
            ]);
        }

        // get cgpa for the semester
        $level = $profile->level()->where('id', $level_id)->first();
        $result = $level->result->where('semester', $request->semester)->first();
        $total_unit = 0;
        $cummulative = 0;
        foreach ($result->unit as $key => $unit) {
            $cummulative = $cummulative + ($unit * $result->grade[$key]);
            $total_unit = $total_unit + $unit;
            $key = $key;
        }
        $cgpa = $cummulative / $total_unit;
        $cgpa = number_format($cgpa, 2);

        // level cgpa
        $total_unit = 0;
        $cummulative = 0;
        $session_result = $level->where('id', $level_id)->first();
        foreach ($session_result->result as $fs_result) {
            foreach ($fs_result->unit as $key => $unit) {
                $cummulative = $cummulative + ($unit * $fs_result->grade[$key]);
                $total_unit = $total_unit + $unit;
            }
        }
        $fs_cgpa = $cummulative / $total_unit;
        $fs_cgpa = number_format($fs_cgpa, 2);
        $remove_route = route('remove_course', [$profile_id, $request->semester, $key, $level_id]);
        return ([
            'course' => $course_[0],
            'unit' => $request->unit[0],
            'grade_alpha' => $request->grade_alpha[0],
            'cgpa' => $cgpa,
            'fs_cgpa' => $fs_cgpa,
            'remove_result' => $remove_route
        ]);
        // return redirect()->route('result', [$profile_id, $level_id]);
    }
    public function remove_course($profile_id, $semester, $key, $level_id)
    {
        $profile = auth()->user()->profile->where('profile_id', $profile_id)->first();
        $level = $profile->level->where('id', $level_id)->first();
        $results = $level->result;
        $semesters = $results->where('semester', $semester)->first();
        $course = $semesters->course;
        $unit = $semesters->unit;
        $grade = $semesters->grade;
        $grade_alpha = $semesters->grade_alpha;


        array_splice($course, $key, 1);
        array_splice($unit, $key, 1);
        array_splice($grade, $key, 1);
        array_splice($grade_alpha, $key, 1);

        $semesters->update([
            'course' => $course,
            'unit' => $unit,
            'grade' => $grade,
            'grade_alpha' => $grade_alpha
        ]);
        $cgpa1 = 'X.XX';
        $cgpa2 = 'X.XX';

        // level cgpa
        function levelCgpa($level, $level_id)
        {
            $total_unit = 0;
            $cummulative = 0;
            $session_result = $level->where('id', $level_id)->first();
            foreach ($session_result->result as $fs_result) {
                foreach ($fs_result->unit as $key => $unit) {
                    $cummulative = $cummulative + ($unit * $fs_result->grade[$key]);
                    $total_unit = $total_unit + $unit;
                }
            }
            $fs_cgpa = $cummulative / $total_unit;
            $fs_cgpa = number_format($fs_cgpa, 2);
            return $fs_cgpa;
        }

        // dd($course);
        if (empty($course)) {
            $semesters->delete();
            $result = Result::where('level_id', $level_id)->first();
            if (!$result) {
                return 'result empty';
            }
            return ([
                'semester' => $semester . 'empty',
                'fs_cgpa' => levelCgpa($level, $level_id)
            ]);
        }

        // get cgpa for the semester
        if ($semester == 'first') {
            $level = $profile->level()->where('id', $level_id)->first();
            $result = $level->result->where('semester', $semester)->first();
            $total_unit = 0;
            $cummulative = 0;
            foreach ($result->unit as $key => $unit) {
                $cummulative = $cummulative + ($unit * $result->grade[$key]);
                $total_unit = $total_unit + $unit;
                $key = $key;
            }
            $cgpa = $cummulative / $total_unit;
            $cgpa1 = number_format($cgpa, 2);
            return ([
                'cgpa1' => $cgpa1,
                'fs_cgpa' => levelCgpa($level, $level_id)
            ]);
        } else {
            $level = $profile->level()->where('id', $level_id)->first();
            $result = $level->result->where('semester', $semester)->first();
            $total_unit = 0;
            $cummulative = 0;
            foreach ($result->unit as $key => $unit) {
                $cummulative = $cummulative + ($unit * $result->grade[$key]);
                $total_unit = $total_unit + $unit;
                $key = $key;
            }
            $cgpa = $cummulative / $total_unit;
            $cgpa2 = number_format($cgpa, 2);
            return ([
                'cgpa2' => $cgpa2,
                'fs_cgpa' => levelCgpa($level, $level_id)
            ]);
        }
    }
}