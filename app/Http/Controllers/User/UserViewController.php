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

        if (!session()->has('exam_end_time')) {
            session(['exam_end_time' => now()->addMinutes($schedule->total_time)->timestamp]);
        }

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

    public function clearSession(Request $request)
    {
        session()->forget([
            'current_question',
            'exam_end_time',
        ]);

        return response()->json(['success' => true]);
    }

    public function getAllAnswers(Request $request)
    {
        $schedule = ExamSchedule::find($request->schedule_id);
        $allQuestions = QuestionBank::where('exam_bank_id', $schedule->exam_bank_id)
            ->orderBy('id')
            ->get();

        $answers = ExamAnswer::where([
            'exam_schedule_id' => $request->schedule_id,
            'student_id' => Auth::user()->id
        ])->get();

        $formattedAnswers = $allQuestions->map(function ($question, $index) use ($answers) {
            $answer = $answers->where('question_bank_id', $question->id)->first();

            return [
                'question_index' => $index,
                'answer' => $answer ? $answer->answer : null,
                'is_flagged' => $answer ? $answer->is_flagged : false,
                'is_answered' => !is_null($answer)
            ];
        });

        return response()->json(['answers' => $formattedAnswers]);
    }
}
