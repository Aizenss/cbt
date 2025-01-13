<?php

namespace App\Http\Controllers;

use App\Models\ExamSchedule;
use App\Models\ShareExam;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $student = Student::where('id', Auth::user()->id)->first();
        $class = ShareExam::where('class_id', $student->departement_class_id)->get();
        return view('user.dashboard', compact('class'));
    }
    public function indexAdmin()
    {
        return view('dashboard');
    }

    public function create()
    {
        //
    }
    public function show(Request $request)
    {
        $data = ShareExam::where('id', $request->data)->first();
        return view('user.detail', compact('data'));
    }
}
