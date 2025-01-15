<?php

namespace App\Http\Controllers;

use App\Models\ExamAnswer;
use App\Models\ExamSchedule;
use App\Models\ShareExam;
use App\Models\Student;
use App\Models\StudentAnswer;
use App\Models\ExamStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $student = Student::where('id', Auth::user()->id)->first();
        $class = ShareExam::where('class_id', $student->departement_class_id)->get();

        // Tambahkan data jumlah soal yang status ujiannya
        foreach($class as $item) {
            $answeredQuestions = ExamAnswer::where('student_id', $student->id)
                ->where('exam_schedule_id', $item->examSchedule->id)
                ->count();
            $item->answered_questions = $answeredQuestions;

            // Cek status ujian dengan is_finish = 'yes'
            $examStatus = ExamStatus::where('student_id', $student->id)
                ->where('exam_schedule_id', $item->examSchedule->id)
                ->where('is_finished', 'yes')
                ->first();
            $item->is_finished = $examStatus ? true : false;
        }

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
