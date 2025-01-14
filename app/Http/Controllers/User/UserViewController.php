<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ExamSchedule;
use App\Models\QuestionBank;
use App\Models\ExamAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserViewController extends Controller
{
    public function index(string $id)
    {
        $schedule = ExamSchedule::find($id);
        $questions = QuestionBank::where('exam_bank_id', $schedule->exam_bank_id)->get();
        $currentQuestion = session('current_question', 0);

        if ($currentQuestion >= $questions->count()) {
            $currentQuestion = 0;
            session(['current_question' => 0]);
        }

        if ($questions->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada soal tersedia');
        }

        return view('user.exam.index', compact('schedule', 'questions', 'currentQuestion'));
    }

    public function saveAnswer(Request $request)
    {
        $answer = ExamAnswer::updateOrCreate(
            [
                'exam_schedule_id' => $request->schedule_id,
                'question_bank_id' => $request->question_id,
                'student_id' => Auth::user()->id,
            ],
            [
                'answer' => $request->answer,
                'is_flagged' => $request->is_flagged ? 1 : 0
            ]
        );

        session(['current_question' => $request->next_question]);

        return response()->json(['success' => true, 'message' => 'Jawaban berhasil disimpan']);
    }

    public function show()
    {
        return view('user.exam.complete');
    }

    public function getAnswer(Request $request)
    {
        $answer = ExamAnswer::where([
            'exam_schedule_id' => $request->schedule_id,
            'question_bank_id' => $request->question_id,
        ])->first();

        return response()->json([
            'answer' => $answer ? $answer->answer : null,
            'is_flagged' => $answer ? (bool)$answer->is_flagged : false
        ]);
    }
}
